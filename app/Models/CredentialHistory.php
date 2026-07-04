<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CredentialHistory extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'credential_id',
        'user_id',
        'action',
        'description',
    ];

    public function credential()
    {
        return $this->belongsTo(Credential::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
