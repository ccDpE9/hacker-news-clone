<?php

namespace App\Http\Requests;

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

    
    public function rules(Request $request)
    {
        $rules = $this->rules;

        if ($request->has('comment_id')) {
            $rules['comment_id'] = 'integer'
        }

        return $rules;
    }

}
