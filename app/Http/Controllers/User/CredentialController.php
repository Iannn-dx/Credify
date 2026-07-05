<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CredentialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $credentials = auth()->user()->credentials()->latest()->paginate(10);

        return view('user.credentials.index', compact('credentials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('user.credentials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'issuer'      => 'required|string|max:255',
            'type'        => 'required|string|in:education,work,certificate,id',
            'issue_date'  => 'required|date',
            'expiry_date' => 'nullable|date|after_or_equal:issue_date',
            'description' => 'nullable|string|max:1000',
            'file'        => 'required|file|mimes:pdf,png,jpg,jpeg|max:10240',
        ]);

        $filePath = $request->file('file')->store('credentials', 'public');

        auth()->user()->credentials()->create([
            'title'       => $validated['title'],
            'issuer'      => $validated['issuer'],
            'type'        => $validated['type'],
            'issue_date'  => $validated['issue_date'],
            'expiry_date' => $validated['expiry_date'] ?? null,
            'description' => $validated['description'] ?? null,
            'file_path'   => $filePath,
            'status'      => 'pending',
        ]);

        return redirect()->route('credentials.index')->with('success', 'Credential uploaded successfully!');
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
