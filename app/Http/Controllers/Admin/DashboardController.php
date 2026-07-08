<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Credential;
use App\Models\User;
use App\Models\Verification;
use App\Models\VerificationRequest;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'users' => User::count(),
            'credentials' => Credential::count(),
            'pending_requests' => VerificationRequest::where('status', 'pending')->count(),
            'verifications' => Verification::count(),
            'verified' => Verification::where('status', 'verified')->count(),
            'rejected_credentials' => Credential::where('status', 'rejected')->count(),
        ];

        $recentRequests = VerificationRequest::query()
            ->with(['credential', 'user'])
            ->latest('requested_at')
            ->latest('id')
            ->limit(5)
            ->get();

        $recentCredentials = Credential::query()
            ->with('user')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentRequests', 'recentCredentials'));
    }
}
