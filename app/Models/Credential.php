<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'type',
        'issuer',
        'issue_date',
        'expiry_date',
        'file_path',
        'status',
        'description',
    ];

    // owner of credential
    public function user(){
        return $this->belongsTo(User::class);
    }

    // verification request
    public function verificationRequests(){
        return $this->hasMany(VerificationRequest::class);
    }

    // verification result
    public function verifications(){
        return $this->hasMany(Verification::class);
    }

    // history
    public function histories(){
        return $this->hasMany(CredentialHistory::class);
    }
}
