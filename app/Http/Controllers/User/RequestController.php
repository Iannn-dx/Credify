<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $statuses = ['pending', 'accepted', 'declined', 'completed'];

        $query = auth()->user()->verificationRequest()
            ->with('credential')
            ->latest('requested_at')
            ->latest('id');

        if ($request->filled('status') && in_array($request->status, $statuses, true)) {
            $query->where('status', $request->status);
        }

        $requests = $query->paginate(10)->withQueryString();

        return view('user.requests.index', compact('requests', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $credentials = auth()->user()->credentials()->latest()->get();
        $selectedCredentialId = $request->query('credential_id');

        if ($selectedCredentialId && ! $credentials->contains('id', (int) $selectedCredentialId)) {
            $selectedCredentialId = null;
        }

        return view('user.requests.create', compact('credentials', 'selectedCredentialId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'credential_id' => 'required|integer',
            'message'       => 'nullable|string',
        ]);

        $credential = auth()->user()->credentials()->findOrFail($validated['credential_id']);

        auth()->user()->verificationRequest()->create([
            'credential_id' => $credential->id,
            'status'        => 'pending',
            'message'       => $validated['message'] ?? null,
            'requested_at'  => now(),
        ]);

        return redirect()
            ->route('requests.index')
            ->with('success', 'Verification request submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
