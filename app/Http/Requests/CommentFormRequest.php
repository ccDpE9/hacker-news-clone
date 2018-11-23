<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class CommentFormRequest extends FormRequest
{

    protected $rules = [
        'body' => 'bail|required',
        'link_id' => 'required|integer',
    ];


    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        $rules = $this->rules;

        if ($this->has('comment_id')) {
            $rules['comment_id'] = 'required|integer';
        }

        return $rules;
    }

}
