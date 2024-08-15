<?php

namespace App\Http\Requests\V1\Task;

use App\Enums\TaskType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class TaskStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'body' => 'nullable|string',
            'space_id' => 'required|string|exists:spaces,uuid',
            'type' => ['required', 'string', new Enum(TaskType::class)],
            'status' => 'nullable|integer',
            'task_id' => 'nullable|integer',
        ];
    }
}
