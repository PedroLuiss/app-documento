<?php

namespace App\Http\Requests\document;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DocumentStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->id;
        return [
            'doc_nombre' =>
            [
                'required',
                'max:60'
            ],
            'doc_contenido' =>['required', 'max:4000', 'regex:/^[a-zA-Z0-9\s]+$/'],
            'tip_tipo_doc_id' =>['required', 'numeric'],
            'pro_proceso_id' =>['required', 'numeric'],
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'doc_nombre.required' => 'El campo nombre es obligatorio.',
            'doc_nombre.max' => 'El campo nombre debe ser maximo 60 caracteres.',

            'doc_contenido.required' => 'El campo contenido es obligatorio.',
            'doc_contenido.max' => 'El campo contenido debe ser maximo 4000 letras.',
            'doc_contenido.regex' => 'El campo contenido no aceptas caracteres extraños.',

            'tip_tipo_doc_id.required' => 'El campo tipo es obligatorio.',
            'tip_tipo_doc_id.numeric' => 'El campo tipo solo permite numeros.',

            'pro_proceso_id.required' => 'El campo proceso es obligatorio.',
            'pro_proceso_id.numeric' => 'El campo proceso solo permite numeros.',

        ];
    }


        /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        $dataResp=[
            "errors"=>$validator->errors(),
            "return"=>false
        ];
        throw new HttpResponseException(response()->json($dataResp, 422));
    }
}
