<?php

use App\Models\Credential;
use App\Models\CredentialHistory;
use App\Models\User;
use App\Models\Verification;
use App\Models\VerificationRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('history page is protected by authentication', function () {
    $response = $this->get(route('history.index'));
    $response->assertRedirect('/login');
});

test('history page is accessible by verified users', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);

    $response = $this->actingAs($user)->get(route('history.index'));
    $response->assertOk();
    $response->assertViewIs('user.history.index');
});

test('credential creation automatically logs an uploaded history record', function () {
    $user = User::factory()->create();

    $credential = Credential::factory()->create([
        'user_id' => $user->id,
        'title' => 'My Bachelor Degree',
        'type' => 'education',
        'issuer' => 'Harvard University',
        'issue_date' => '2023-01-01',
        'status' => 'pending',
        'file_path' => 'credentials/sample.pdf',
    ]);

    $this->assertDatabaseHas('credential_histories', [
        'credential_id' => $credential->id,
        'user_id' => $user->id,
        'action' => 'uploaded',
        'description' => 'Uploaded credential: My Bachelor Degree',
    ]);
});

test('verification request creation automatically logs a requested history record', function () {
    $user = User::factory()->create();
    $credential = Credential::factory()->create([
        'user_id' => $user->id,
        'title' => 'Work Experience Letter',
        'type' => 'work',
        'file_path' => 'credentials/work.pdf',
    ]);

    $request = VerificationRequest::create([
        'credential_id' => $credential->id,
        'requested_by' => $user->id,
        'status' => 'pending',
        'requested_at' => now(),
    ]);

    $this->assertDatabaseHas('credential_histories', [
        'credential_id' => $credential->id,
        'user_id' => $user->id,
        'action' => 'requested',
        'description' => 'Submitted verification request for Work Experience Letter',
    ]);
});

test('verification creation automatically logs status history record', function () {
    $user = User::factory()->create(['name' => 'John Doe']);
    $verifier = User::factory()->create(['name' => 'Verifier Sally']);
    $credential = Credential::factory()->create([
        'user_id' => $user->id,
        'title' => 'AWS Certified Developer',
        'type' => 'certificate',
        'file_path' => 'credentials/aws.pdf',
    ]);

    $verification = Verification::create([
        'credential_id' => $credential->id,
        'verifier_id' => $verifier->id,
        'status' => 'verified',
        'remarks' => 'Valid and certified.',
        'verified_at' => now(),
    ]);

    $this->assertDatabaseHas('credential_histories', [
        'credential_id' => $credential->id,
        'user_id' => $user->id,
        'action' => 'verified',
        'description' => "Credential 'AWS Certified Developer' was verified by verifier Verifier Sally (Remarks: Valid and certified.)",
    ]);
});

test('history index supports search and action filters', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);

    $credential1 = Credential::factory()->create(['user_id' => $user->id, 'title' => 'Important Doc A']);
    $credential2 = Credential::factory()->create(['user_id' => $user->id, 'title' => 'Secret Doc B']);

    // Make a request which triggers requested history
    VerificationRequest::create([
        'credential_id' => $credential1->id,
        'requested_by' => $user->id,
        'status' => 'pending',
        'requested_at' => now(),
    ]);

    // Verify search works
    $response = $this->actingAs($user)->get(route('history.index', ['search' => 'Important']));
    $response->assertSee('Uploaded credential: Important Doc A');
    $response->assertDontSee('Uploaded credential: Secret Doc B');

    // Verify action filtering works
    $response = $this->actingAs($user)->get(route('history.index', ['action' => 'requested']));
    $response->assertSee('Submitted verification request for Important Doc A');
    $response->assertDontSee('Uploaded credential: Important Doc A');
});
