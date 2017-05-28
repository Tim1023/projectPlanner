<?php

namespace ProgramPlanner\Http\Requests;

use ProgramPlanner\Http\Requests\Request;

class ProgramSemesterRequest extends Request
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
            'semester_id' => 'required',
            'name' => 'required|min:5|max:255',
            'order_number' => 'numeric',
            'program_semester_course_list' => 'array'
        ];
    }
}
