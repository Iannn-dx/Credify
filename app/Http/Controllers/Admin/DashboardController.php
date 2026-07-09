<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Credential;
use App\Models\CredentialHistory;
use App\Models\User;
use App\Models\Verification;
use App\Models\VerificationRequest;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalCredentials = Credential::count();
        $verifiedCount = Verification::where('status', 'verified')->count();

        $stats = [
            'users' => User::count(),
            'admins' => User::where('role', User::ROLE_ADMIN)->count(),
            'regular_users' => User::where('role', User::ROLE_USER)->count(),
            'credentials' => $totalCredentials,
            'pending_credentials' => Credential::where('status', 'pending')->count(),
            'unverified_credentials' => Credential::where('status', 'unverified')->count(),
            'rejected_credentials' => Credential::where('status', 'rejected')->count(),
            'total_requests' => VerificationRequest::count(),
            'pending_requests' => VerificationRequest::where('status', 'pending')->count(),
            'completed_requests' => VerificationRequest::where('status', 'completed')->count(),
            'declined_requests' => VerificationRequest::where('status', 'declined')->count(),
            'verifications' => Verification::count(),
            'verified' => $verifiedCount,
            'rejected_verifications' => Verification::where('status', 'rejected')->count(),
            'credential_histories' => CredentialHistory::count(),
            'verified_percent' => $totalCredentials > 0
                ? (int) round(($verifiedCount / $totalCredentials) * 100)
                : 0,
        ];

        $pendingRequests = VerificationRequest::query()
            ->with(['credential', 'user'])
            ->where('status', 'pending')
            ->latest('requested_at')
            ->latest('id')
            ->limit(5)
            ->get();

        $recentCredentials = Credential::query()
            ->with('user')
            ->latest()
            ->limit(5)
            ->get();

        $recentVerifications = Verification::query()
            ->with(['credential', 'verifier'])
            ->latest('verified_at')
            ->latest('id')
            ->limit(5)
            ->get();

        $recentUsers = User::query()
            ->latest()
            ->limit(5)
            ->get();

        $activities = $this->buildActivityFeed();

        return view('admin.dashboard', compact(
            'stats',
            'pendingRequests',
            'recentCredentials',
            'recentVerifications',
            'recentUsers',
            'activities',
        ));
    }

    private function buildActivityFeed(): Collection
    {
        $items = collect();

        foreach (CredentialHistory::query()->with(['credential', 'user'])->latest()->limit(8)->get() as $history) {
            $userName = $history->user?->name ?? 'User';
            $items->push([
                'message' => "{$userName}: {$history->description}",
                'at' => $history->created_at,
                'tone' => match ($history->action) {
                    'verified' => 'emerald',
                    'rejected' => 'rose',
                    'uploaded' => 'indigo',
                    default => 'gray',
                },
            ]);
        }

        foreach (VerificationRequest::query()->with(['credential', 'user'])->latest('requested_at')->limit(6)->get() as $request) {
            $userName = $request->user?->name ?? 'User';
            $title = $request->credential?->title ?? 'credential';
            $items->push([
                'message' => "{$userName} requested verification for {$title} ({$request->status})",
                'at' => $request->requested_at ?? $request->created_at,
                'tone' => match ($request->status) {
                    'completed' => 'emerald',
                    'declined' => 'rose',
                    'pending' => 'amber',
                    default => 'gray',
                },
            ]);
        }

        foreach (Verification::query()->with(['credential', 'verifier'])->latest('verified_at')->limit(6)->get() as $verification) {
            $verifierName = $verification->verifier?->name ?? 'Verifier';
            $title = $verification->credential?->title ?? 'credential';
            $items->push([
                'message' => "{$verifierName} recorded {$verification->status} for {$title}",
                'at' => $verification->verified_at ?? $verification->created_at,
                'tone' => $verification->status === 'verified' ? 'emerald' : 'rose',
            ]);
        }

        foreach (Credential::query()->with('user')->latest()->limit(4)->get() as $credential) {
            $userName = $credential->user?->name ?? 'User';
            $items->push([
                'message' => "{$userName} uploaded {$credential->title}",
                'at' => $credential->created_at,
                'tone' => 'indigo',
            ]);
        }

        return $items->sortByDesc('at')->take(10)->values();
    }
}
