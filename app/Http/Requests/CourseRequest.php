<?php

namespace ProgramPlanner\Http\Requests;

use ProgramPlanner\Http\Requests\Request;
use ProgramPlanner\Enums\Level;

class CourseRequest extends Request
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
            'department_id' => 'exists:departments,id'
        ];
    }
}
