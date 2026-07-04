<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public const ROLE_USER = 'user';

    public const ROLE_ADMIN = 'admin';

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isUser(): bool
    {
        return $this->role === self::ROLE_USER;
    }

    public function homeRoute(): string
    {
        return $this->isAdmin()
            ? route('admin.dashboard')
            : route('dashboard');
    }

    // credentials owned by the user
    public function credentials(){
        return $this->hasMany(Credential::class);
    }

    // history created by the user
    public function credentialHistories(){
        return $this->hasMany(CredentialHistory::class);
    }

    // verification done by user 
    public function verifications(){
        return $this->hasMany(Verification::class, 'verifier_id');
    }

    // request made by user
    public function verificationRequest(){
        return $this->hasMany(VerificationRequest::class, 'requested_by');
    }

}
