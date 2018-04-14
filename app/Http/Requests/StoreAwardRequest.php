<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use App\Exceptions\PostTooOftenException;
use App\Award;

class StoreAwardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('create', Award::class);
    }

    public function failedAuthorization()
    {
        throw new PostTooOftenException();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['max:100', 'required'],
            'image' => [
                'image',
                'required',
                'max:5000',
            ],
            'tags' => ['array']
        ];
    }
}
