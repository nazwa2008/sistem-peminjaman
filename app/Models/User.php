<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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
    
    // As Borrower
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'user_id');
    }

    // As Officer who created the entry
    public function processedLoans()
    {
        return $this->hasMany(Peminjaman::class, 'petugas_id');
    }

    // As Officer who approved/rejected
    public function approvedLoans()
    {
        return $this->hasMany(Peminjaman::class, 'approver_id');
    }

    // As Officer who handled returns
    public function handledReturns()
    {
        return $this->hasMany(PeminjamanDetail::class, 'returned_by_id');
    }

}
