<?php

namespace Database\Seeders;

use App\Models\Credential;
use App\Models\CredentialHistory;
use App\Models\Verification;
use App\Models\VerificationRequest;
use Illuminate\Database\Seeder;

class CredentialHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Backfill uploaded credentials
        $credentials = Credential::all();
        $this->command->info("Checking " . $credentials->count() . " credentials for history backfill...");
        
        foreach ($credentials as $credential) {
            $exists = CredentialHistory::where([
                'credential_id' => $credential->id,
                'user_id'       => $credential->user_id,
                'action'        => 'uploaded',
            ])->exists();

            if (!$exists) {
                CredentialHistory::create([
                    'credential_id' => $credential->id,
                    'user_id'       => $credential->user_id,
                    'action'        => 'uploaded',
                    'description'   => "Uploaded credential: {$credential->title}",
                    'created_at'    => $credential->created_at,
                    'updated_at'    => $credential->updated_at,
                ]);
            }
        }

        // 2. Backfill verification requests
        $requests = VerificationRequest::with('credential')->get();
        $this->command->info("Checking " . $requests->count() . " verification requests for history backfill...");

        foreach ($requests as $request) {
            if (!$request->credential) {
                continue;
            }

            $exists = CredentialHistory::where([
                'credential_id' => $request->credential_id,
                'user_id'       => $request->credential->user_id,
                'action'        => 'requested',
            ])->exists();

            if (!$exists) {
                CredentialHistory::create([
                    'credential_id' => $request->credential_id,
                    'user_id'       => $request->credential->user_id,
                    'action'        => 'requested',
                    'description'   => "Submitted verification request for {$request->credential->title}",
                    'created_at'    => $request->requested_at ?? $request->created_at,
                    'updated_at'    => $request->updated_at,
                ]);
            }
        }

        // 3. Backfill verifications
        $verifications = Verification::with(['credential', 'verifier'])->get();
        $this->command->info("Checking " . $verifications->count() . " verifications for history backfill...");

        foreach ($verifications as $verification) {
            if (!$verification->credential) {
                continue;
            }

            $statusStr = $verification->status === 'verified' ? 'verified' : 'rejected';

            $exists = CredentialHistory::where([
                'credential_id' => $verification->credential_id,
                'user_id'       => $verification->credential->user_id,
                'action'        => $statusStr,
            ])->exists();

            if (!$exists) {
                $remarksStr = $verification->remarks ? " (Remarks: {$verification->remarks})" : "";
                
                CredentialHistory::create([
                    'credential_id' => $verification->credential_id,
                    'user_id'       => $verification->credential->user_id,
                    'action'        => $statusStr,
                    'description'   => "Credential '{$verification->credential->title}' was {$statusStr} by verifier " . ($verification->verifier?->name ?? 'Admin') . "{$remarksStr}",
                    'created_at'    => $verification->verified_at ?? $verification->created_at,
                    'updated_at'    => $verification->updated_at,
                ]);
            }
        }

        $this->command->info("History backfill complete!");
    }
}
