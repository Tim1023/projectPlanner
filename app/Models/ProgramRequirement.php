<?php

namespace ProgramPlanner\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramRequirement extends Model
{
    protected $table = 'program_requirement';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['program_id', 'level', 'minimum_credits', 'maximum_credits', 'allowed'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public $timestamps =false;
    public function program(){
        return $this->belongsTo(Program::class);
    }
}
