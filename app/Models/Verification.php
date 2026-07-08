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
}
