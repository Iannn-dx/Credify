<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VerificationRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VerificationRequestController extends Controller
{
    public function index(Request $request): View
    {
        $statuses = ['pending', 'accepted', 'declined', 'completed'];

        $query = VerificationRequest::query()
            ->with(['credential', 'user'])
            ->latest('requested_at')
            ->latest('id');

        if ($request->filled('status') && in_array($request->status, $statuses, true)) {
            $query->where('status', $request->status);
        }

        $requests = $query->paginate(15)->withQueryString();

        return view('admin.requests.index', compact('requests', 'statuses'));
    }

    public function show(VerificationRequest $verificationRequest): View
    {
        $verificationRequest->load(['credential.user', 'user']);

        return view('admin.requests.show', compact('verificationRequest'));
    }
}
