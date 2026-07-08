<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $roles = [User::ROLE_USER, User::ROLE_ADMIN];

        $query = User::query()
            ->withCount(['credentials', 'verificationRequest', 'verifications'])
            ->latest('id');

        if ($request->filled('role') && in_array($request->role, $roles, true)) {
            $query->where('role', $request->role);
        }

        $users = $query->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function show(User $user): View
    {
        $user->loadCount(['credentials', 'verificationRequest', 'verifications', 'credentialHistories']);

        $credentials = $user->credentials()->latest()->limit(10)->get();
        $verificationRequests = $user->verificationRequest()->with('credential')->latest()->limit(10)->get();

        return view('admin.users.show', compact('user', 'credentials', 'verificationRequests'));
    }
}
