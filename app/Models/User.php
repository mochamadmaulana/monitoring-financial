<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_lengkap',
        'role',
        'username',
        'status',
        'email',
        'password',
        'aktif',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeSearch(Builder $query, string $filters = null) : void
    {
        $query->when($filters ?? false, fn($query, $search) =>
            $query->where('nama_lengkap','like','%'.$search.'%')
                ->orWhere('username','like','%'.$search.'%')
                ->orWhere('email','like','%'.$search.'%')
                // ->orWhereHas('kantor',fn($query) =>
                //     $query->where('nama_kantor','like','%'.$search.'%')
                // )
        );
    }
    function rekening()
    {
        return $this->hasMany(Rekening::class);
    }
    function pemasukan()
    {
        return $this->hasMany(Pemasukan::class);
    }
}
