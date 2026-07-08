<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Credential;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CredentialController extends Controller
{
    public function index(Request $request): View
    {
        $statuses = ['pending', 'unverified', 'rejected'];

        $query = Credential::query()
            ->with('user')
            ->latest('id');

        if ($request->filled('status') && in_array($request->status, $statuses, true)) {
            $query->where('status', $request->status);
        }

        $credentials = $query->paginate(15)->withQueryString();

        return view('admin.credentials.index', compact('credentials', 'statuses'));
    }
}
