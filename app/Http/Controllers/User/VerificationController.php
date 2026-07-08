<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Verification;
use App\Models\VerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class VerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $statuses = ['verified', 'rejected'];

        $query = Verification::query()
            ->with(['credential', 'verifier'])
            ->where(function ($query) {
                $query->where('verifier_id', auth()->id())
                    ->orWhereHas('credential', fn ($credential) => $credential->where('user_id', auth()->id()));
            })
            ->latest('verified_at')
            ->latest('id');

        if ($request->filled('status') && in_array($request->status, $statuses, true)) {
            $query->where('status', $request->status);
        }

        $verifications = $query->paginate(10)->withQueryString();

        $pendingRequests = VerificationRequest::query()
            ->with(['credential', 'user'])
            ->where('status', 'pending')
            ->latest('requested_at')
            ->latest('id')
            ->get();

        return view('user.verifications.index', compact('verifications', 'statuses', 'pendingRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $pendingRequests = VerificationRequest::query()
            ->with(['credential', 'user'])
            ->where('status', 'pending')
            ->latest('requested_at')
            ->latest('id')
            ->get();

        $selectedRequestId = $request->query('verification_request_id');

        if ($selectedRequestId && ! $pendingRequests->contains('id', (int) $selectedRequestId)) {
            $selectedRequestId = null;
        }

        return view('user.verifications.create', compact('pendingRequests', 'selectedRequestId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'verification_request_id' => 'required|integer|exists:verification_requests,id',
            'status'                  => 'required|in:verified,rejected',
            'remarks'                 => 'nullable|string',
        ]);

        $verificationRequest = VerificationRequest::query()
            ->with('credential')
            ->where('status', 'pending')
            ->findOrFail($validated['verification_request_id']);

        DB::transaction(function () use ($validated, $verificationRequest) {
            Verification::create([
                'credential_id' => $verificationRequest->credential_id,
                'verifier_id'   => auth()->id(),
                'status'        => $validated['status'],
                'remarks'       => $validated['remarks'] ?? null,
                'verified_at'   => now(),
            ]);

            $verificationRequest->update([
                'status'       => $validated['status'] === 'verified' ? 'completed' : 'declined',
                'responded_at' => now(),
            ]);

            if ($validated['status'] === 'rejected' && $verificationRequest->credential) {
                $verificationRequest->credential->update(['status' => 'rejected']);
            }
        });

        return redirect()
            ->route('verification.index')
            ->with('success', 'Verification recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Verification $verification): View
    {
        abort_unless(
            $verification->verifier_id === auth()->id()
            || $verification->credential?->user_id === auth()->id(),
            403
        );

        $verification->load(['credential', 'verifier']);

        return view('user.verifications.show', compact('verification'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
