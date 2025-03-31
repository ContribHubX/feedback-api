<?php
namespace App\Http\Requests\Feedback;

use App\Models\Feedback;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFeedbackRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            Feedback::ACKNOWLEDGE_CONTENT => 'string'
        ];
    }
}
