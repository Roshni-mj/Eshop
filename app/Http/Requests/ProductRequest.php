<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        return [
            'title' =>['required', 'max:255'],
            'description' =>['required','max:1000'],
            'price' =>['required','min:1'],
            'stock' =>['required','min:0'],
            'status' =>['required','in:available,unavailable'],
            'images.*' => ['nullable','image'],
        ];
    }
    public function withvalidator($validator)
    {
        $validator->after(function($validator){
            if ($this->stock == 0 && $this->status == 'available')
            {
                $validator->errors()->add('stock','If available must have stock');
            }
        });
    }
}
