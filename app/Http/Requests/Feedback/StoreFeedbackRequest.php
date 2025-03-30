<?php
namespace App\Http\Requests\Feedback;


use App\Enums\RatingEnums;
use App\Models\Feedback;
use Illuminate\Foundation\Http\FormRequest;

class StoreFeedbackRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            Feedback::FEEDBACK_CONTENT => 'string',
            Feedback::RATING => 'required|in:'.$this->ratingValues()
        ];
    }

    private function ratingValues(): string
    {
        return implode(',', RatingEnums::values());
    }
}
