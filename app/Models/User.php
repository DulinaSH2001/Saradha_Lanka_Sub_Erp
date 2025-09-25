<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'avatar',
        'position',
        'department',
        'date_of_birth',
        'employee_id',
        'last_login_at',
        'last_login_ip',
        'is_active',
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
            'date_of_birth' => 'date',
            'last_login_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get the user's settings.
     */
    public function settings()
    {
        return $this->hasOne(UserSettings::class);
    }

    /**
     * Get the user's full name.
     */
    public function getFullNameAttribute()
    {
        return trim($this->first_name . ' ' . $this->last_name) ?: $this->name;
    }

    /**
     * Get the user's initials.
     */
    public function getInitialsAttribute()
    {
        $name = $this->full_name;
        $words = explode(' ', $name);
        $initials = '';
        foreach ($words as $word) {
            $initials .= substr($word, 0, 1);
        }
        return strtoupper(substr($initials, 0, 2));
    }

    /**
     * Get the user's avatar URL or initials.
     */
    public function getAvatarUrlAttribute()
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : null;
    }
}
