<?php

namespace ProgramPlanner\Http\Requests;

use ProgramPlanner\Http\Requests\Request;

class ProgramRequirementRequest extends Request
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
            'program_id' => 'exists:program,id',
            'level' => 'required',
            'minimum_credits' => 'required|numeric|min:0|max:480|credit_points',
            'maximum_credits' => 'required|numeric|min:0|max:480|credit_points',
        ];
    }
}
