<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VerificationRequest extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'credential_id',
        'requested_by',
        'status',
        'message',
        'requested_at',
        'responded_at',
    ];

    protected function casts(): array
    {
        return [
            'requested_at' => 'datetime',
            'responded_at' => 'datetime',
        ];
    }

    public function credential(){
        return $this->belongsTo(Credential::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'requested_by');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($request) {
            $request->loadMissing('credential');
            if ($request->credential) {
                CredentialHistory::create([
                    'credential_id' => $request->credential_id,
                    'user_id'       => $request->credential->user_id,
                    'action'        => 'requested',
                    'description'   => "Submitted verification request for {$request->credential->title}",
                ]);
            }
        });
    }
}
