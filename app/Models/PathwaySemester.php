<?php

namespace ProgramPlanner\Models;

use Illuminate\Database\Eloquent\Model;

class PathwaySemester extends Model
{
    protected $table = 'pathway_semester';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['pathway_id', 'semester_id', 'name', 'order_number'];
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
    public function getPathwaySemesterCourseListAttribute(){
        return $this->courses()->lists('course_id')->all();
    }

    /**
     * A user may have multiple roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }

    public function pathway()
    {
        return $this->belongsTo(Pathway::class);
    }

    /**
     * The courses included in this semester
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class,'pathway_semester_course', 'pathway_semester_id', 'course_id');
    }
}
