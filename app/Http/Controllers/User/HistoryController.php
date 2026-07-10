<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HistoryController extends Controller
{
    /**
     * Display a listing of the user's credential histories.
     */
    public function index(Request $request): View
    {
        $user = auth()->user();

        // Allowed filtering actions
        $actions = ['uploaded', 'requested', 'verified', 'rejected'];

        $query = $user->credentialHistories()
            ->with('credential')
            ->latest()
            ->latest('id');

        // Apply action filter
        if ($request->filled('action') && in_array($request->action, $actions, true)) {
            $query->where('action', $request->action);
        }

        // Apply search query
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhereHas('credential', function ($cq) use ($search) {
                      $cq->where('title', 'like', "%{$search}%")
                        ->orWhere('type', 'like', "%{$search}%")
                        ->orWhere('issuer', 'like', "%{$search}%");
                  });
            });
        }

        // Paginate results
        $histories = $query->paginate(10)->withQueryString();

        return view('user.history.index', compact('histories', 'actions'));
    }
}
