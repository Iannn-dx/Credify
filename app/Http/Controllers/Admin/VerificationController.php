<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VerificationController extends Controller
{
    public function index(Request $request): View
    {
        $statuses = ['verified', 'rejected'];

        $query = Verification::query()
            ->with(['credential', 'verifier'])
            ->latest('verified_at')
            ->latest('id');

        if ($request->filled('status') && in_array($request->status, $statuses, true)) {
            $query->where('status', $request->status);
        }

        $verifications = $query->paginate(15)->withQueryString();

        return view('admin.verifications.index', compact('verifications', 'statuses'));
    }
}
