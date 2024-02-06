<?php

namespace App\Http\Requests\Space\V1;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;

class SpaceStoreRequest extends FormRequest
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
        $this['slug'] = Str::slug($this->name);

        return [
            'name' => 'required|string',
            'space_id' => 'nullable|integer',
            'slug' => Rule::unique('spaces', 'slug'),
            'type_id' => 'required|integer|exists:types,id',
        ];
    }
}
