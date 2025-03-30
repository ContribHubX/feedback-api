<?php

namespace App\Http\Requests;

use App\Enums\TaskEnums;
use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            Task::TITLE => 'required|string',
            Task::DESCRIPTION => 'string',
            Task::DUE_DATE => 'required|date|after_or_equal:today',
            Task::PRIORITY  =>'required|in:'.$this->priorityValues(),
        ];
    }

    private function priorityValues(): string
    {
        return implode(',', TaskEnums::get());
    }
}
