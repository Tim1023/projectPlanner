<?php

namespace ProgramPlanner\Http\Requests;

use ProgramPlanner\Http\Requests\Request;

class PathwayRequest extends Request
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
            'name' => 'required|min:5|max:255',
            'description' => 'min:5|max:3000',
            'program_id' => 'exists:programs,id',
        ];
    }
}
