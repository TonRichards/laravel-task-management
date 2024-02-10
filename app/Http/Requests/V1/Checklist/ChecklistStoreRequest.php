<?php

namespace App\Http\Requests\V1\Checklist;

use Illuminate\Foundation\Http\FormRequest;

class ChecklistStoreRequest extends FormRequest
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
        $this['is_checked'] = $this->get('is_checked', 0);

        return [
            'name' => 'required|string',
            'task_id' => 'required|integer'
        ];
    }
}
