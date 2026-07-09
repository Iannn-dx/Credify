<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Verification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        $stats = [
            'total_credentials' => $user->credentials()->count(),
            'verified' => Verification::query()
                ->where('status', 'verified')
                ->whereHas('credential', fn ($query) => $query->where('user_id', $user->id))
                ->count(),
            'pending_credentials' => $user->credentials()->where('status', 'pending')->count(),
            'unverified_credentials' => $user->credentials()->where('status', 'unverified')->count(),
            'rejected_credentials' => $user->credentials()->where('status', 'rejected')->count(),
            'pending_requests' => $user->verificationRequest()->where('status', 'pending')->count(),
            'total_requests' => $user->verificationRequest()->count(),
        ];

        $stats['verified_percent'] = $stats['total_credentials'] > 0
            ? (int) round(($stats['verified'] / $stats['total_credentials']) * 100)
            : 0;

        $recentCredentials = $user->credentials()
            ->with(['verifications' => fn ($query) => $query->latest('verified_at')->limit(1)])
            ->latest()
            ->limit(5)
            ->get();

        $activities = $this->buildActivityFeed($user);

        return view('dashboard.user', compact('stats', 'recentCredentials', 'activities'));
    }

    private function buildActivityFeed($user): Collection
    {
        $items = collect();

        foreach ($user->credentialHistories()->with('credential')->latest()->limit(10)->get() as $history) {
            $items->push([
                'message' => $history->description,
                'at' => $history->created_at,
                'tone' => match ($history->action) {
                    'verified' => 'emerald',
                    'rejected' => 'rose',
                    'uploaded' => 'indigo',
                    default => 'gray',
                },
            ]);
        }

        if ($items->isNotEmpty()) {
            return $items->sortByDesc('at')->take(8)->values();
        }

        foreach ($user->credentials()->latest()->limit(5)->get() as $credential) {
            $items->push([
                'message' => "Uploaded {$credential->title}",
                'at' => $credential->created_at,
                'tone' => 'indigo',
            ]);
        }

        foreach ($user->verificationRequest()->with('credential')->latest('requested_at')->limit(5)->get() as $request) {
            $title = $request->credential?->title ?? 'credential';
            $items->push([
                'message' => "Submitted verification request for {$title} ({$request->status})",
                'at' => $request->requested_at ?? $request->created_at,
                'tone' => match ($request->status) {
                    'completed' => 'emerald',
                    'declined' => 'rose',
                    'pending' => 'amber',
                    default => 'gray',
                },
            ]);
        }

        $verifications = Verification::query()
            ->with('credential')
            ->whereHas('credential', fn ($query) => $query->where('user_id', $user->id))
            ->latest('verified_at')
            ->limit(5)
            ->get();

        foreach ($verifications as $verification) {
            $title = $verification->credential?->title ?? 'credential';
            $items->push([
                'message' => "{$title} verification {$verification->status}",
                'at' => $verification->verified_at ?? $verification->created_at,
                'tone' => $verification->status === 'verified' ? 'emerald' : 'rose',
            ]);
        }

        return $items->sortByDesc('at')->take(8)->values();
    }
}
