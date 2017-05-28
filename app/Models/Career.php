<?php

namespace ProgramPlanner\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $table = 'careers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function programs(){
        return $this->belongsToMany(Program::class,'career_program','program_id', 'career_id', CareerProgram::class);
    }

    public function pathways(){
        return $this->belongsToMany(Pathway::class,'career_pathway','pathway_id', 'career_id', CareerPathway::class);
    }
}
