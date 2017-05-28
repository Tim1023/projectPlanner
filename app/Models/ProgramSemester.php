<?php

namespace ProgramPlanner\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramSemester extends Model
{
    protected $table = 'program_semester';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['program_id', 'semester_id', 'name', 'order_number'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public $timestamps = false;

    /**
     * @return mixed
     */
    public function getProgramSemesterCourseListAttribute(){
        return $this->courses()->lists('course_id')->all();
    }

    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * The courses included in this semester
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class,'program_semester_course', 'program_semester_id', 'course_id');
    }
}
