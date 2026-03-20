<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravolt\Avatar\Avatar;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'profile_image',
        'password',
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
    public function getProfileImageAttribute($value)
    {
        // If profile_image exists in database, return it
        if ($value) {
            return $value;
        }
        
        // Otherwise, generate an avatar from the user's name
        try {
            // Instantiate Avatar and call create() as an instance method
            $avatar = new Avatar();
            $base64 = $avatar->create($this->name)->toBase64();
            // Ensure it's a proper data URI
            if (!str_starts_with($base64, 'data:')) {
                return 'data:image/svg+xml;base64,' . $base64;
            }
            return $base64;
        } catch (\Exception $e) {
            // Fallback if avatar generation fails
            return null;
        }
    }
}
