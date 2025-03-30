<?php

namespace App\Models;

use App\Models\Attributes\HasDefaultConcreteFields;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory, HasUuids, HasDefaultConcreteFields;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public const TABLE_NAME = "tasks";
    public const USER_ID = 'user_id';
    public const TITLE = 'title';
    public const DESCRIPTION = 'description';
    public const DUE_DATE = 'due_date';
    public const PRIORITY = 'priority';
    public const STATUS = 'status';

    protected $fillable = [
        self::USER_ID,
        self::TITLE,
        self::DESCRIPTION,
        self::DUE_DATE,
        self::PRIORITY,
        self::STATUS,
    ];

    public function isOwnedBy(User $user): bool
    {
        return $this->user_id === $user->id;
    }
}
