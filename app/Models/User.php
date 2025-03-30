<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\RoleEnums;
use App\Models\Attributes\HasDefaultConcreteFields;
use App\Models\Feedback;
use App\Models\Task;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements CanResetPassword
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, HasDefaultConcreteFields, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        self::NAME,
        self::EMAIL,
        self::PASSWORD,
        self::EMAIL_VERIFIED_AT,
        self::VERIFICATION_TOKEN,
        self::ROLE,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        self::PASSWORD,
        self::REMEMBER_TOKEN,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            self::PASSWORD => 'hashed',
            self::ROLE => RoleEnums::class
        ];
    }

    public const TABLE_NAME = "users";

    public const NAME = "name";
    public const EMAIL = "email";
    public const PASSWORD = "password";
    public const REMEMBER_TOKEN = "remember_token";
    public const EMAIL_VERIFIED_AT = "email_verified_at";
    public const VERIFICATION_TOKEN = "verification_token";
    public const ROLE = "role";

    public function feedbacks(){
        return $this->hasMany(Feedback::class);
    }

    public function isAdmin(){
        return $this->role->value === RoleEnums::ADMIN->value;
    }
}
