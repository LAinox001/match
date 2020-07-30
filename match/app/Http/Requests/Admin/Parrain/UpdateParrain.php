<?php

namespace App\Http\Requests\Admin\Parrain;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateParrain extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.parrain.edit', $this->parrain);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'nom' => ['sometimes', 'string'],
            'prenom' => ['sometimes', 'string'],
            'filliere_id' => ['sometimes', 'integer'],
            'plat_id' => ['sometimes', 'integer'],
            'couleur_id' => ['sometimes', 'integer'],
            'animal_id' => ['sometimes', 'integer'],
            'match' => ['sometimes', 'integer']
            
        ];
    }

    /**
     * Modify input data
     *
     * @return array
     */
    public function getSanitized(): array
    {
        $sanitized = $this->validated();


        //Add your code for manipulation with request data here

        return $sanitized;
    }
}
