<?php

namespace App\Http\Requests\Space;

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
            'name' => 'required',
            'slug' => Rule::unique('spaces', 'slug')->whereNull('deleted_at'),
            'type' => [
                'required',
                Rule::exists('types', 'name')->where(function (Builder $query) {
                    return $query->where('scope', 'space');
                }),
            ]
        ];
    }
}
