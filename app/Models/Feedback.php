<?php

namespace App\Models;

use App\Enums\RatingEnums;
use App\Models\Attributes\HasDefaultConcreteFields;
use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    /** @use HasFactory<\Database\Factories\FeedbackFactory> */
    use HasFactory, HasUuids, HasDefaultConcreteFields;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Fields
    public const TABLE_NAME = "feedbacks";
    public const USER_ID = "user_id"; // required
    public const FEEDBACK_CONTENT = "feedback_content"; // nullable
    public const RATING = "rating"; // enum
    public const ACKNOWLEDGED = "acknowledged"; // boolean defaults to false
    public const ACKNOWLEDGE_CONTENT = "acknowledge_content"; // nullable

    protected $fillable = [
        self::USER_ID,
        self::FEEDBACK_CONTENT,
        self::RATING,
        self::ACKNOWLEDGED,
        self::ACKNOWLEDGE_CONTENT,
    ];

    protected function casts() : array
    {
        return [
            self::RATING => RatingEnums::class,
            self::ACKNOWLEDGED => 'boolean',
        ];
    }
}
