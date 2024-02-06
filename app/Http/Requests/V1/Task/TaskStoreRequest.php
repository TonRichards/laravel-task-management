<?php

namespace App\Http\Requests\V1\Task;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;

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
            'space_id' => 'required|integer|exists:spaces,id',
            'type_id' => 'required|integer|exists:types,id',
            'status_id' => 'nullable|integer',
        ];
    }
}
