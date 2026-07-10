<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Verification extends Model
{
    //
     use HasFactory;

    protected $fillable = [
        'credential_id',
        'verifier_id',
        'status',
        'remarks',
        'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'verified_at' => 'datetime',
        ];
    }

    public function credential(){
        return $this->belongsTo(Credential::class);
    }

    public function verifier(){
        return $this->belongsTo(User::class, 'verifier_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($verification) {
            $verification->loadMissing(['credential', 'verifier']);
            if ($verification->credential) {
                $statusStr = $verification->status === 'verified' ? 'verified' : 'rejected';
                $remarksStr = $verification->remarks ? " (Remarks: {$verification->remarks})" : "";
                
                CredentialHistory::create([
                    'credential_id' => $verification->credential_id,
                    'user_id'       => $verification->credential->user_id,
                    'action'        => $statusStr,
                    'description'   => "Credential '{$verification->credential->title}' was {$statusStr} by verifier " . ($verification->verifier?->name ?? 'Admin') . "{$remarksStr}",
                ]);
            }
        });
    }
}
