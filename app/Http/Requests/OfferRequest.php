<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required | max:20 | unique:offers,name',
            'price' => 'required | numeric',
             'photo' => 'required',
        ];
    }
        public function message(){
            return [
                'name.required' => 'name is required', 
                'name.max'      => 'name is have length 20',
                'name.unique'   => 'name is have been taken',
                'price.required'=> 'price is required',
                'price.numeric' => 'price is a number',
                 'photo.required'=> 'photo is required'
     
            ];
        }
}
