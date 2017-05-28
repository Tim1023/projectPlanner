<?php

namespace ProgramPlanner\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property mixed department_id
 * @property mixed program_semesters
 * @property mixed careers
 * @property mixed career_list
 * @property mixed compulsory_courses
 */
class Program extends Model
{
    protected $table = 'programs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'department_id', 'credits'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The custom attributes defined in this model
     */
    protected $appends = ['credit_points', 'career_list'];



    /**
     * Returns the credit points in a formatted string
     * @return string
     */
    public function getCreditPointsAttribute()
    {
        $this->attributes['credit_points'] = $this->attributes['credits'] . ' Credit Points';
        return ucfirst($this->attributes['credit_points']);
    }

    /**
     * A user may have multiple roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function compulsory_courses(){
        return $this->belongsToMany(Course::class,'compulsory_course_program', 'program_id', 'course_id');
    }

    /**
     * gets all the courses attached to this program through all the semesters
     * this is just a shortcut to get all the courses in one list
     * @return Collection
     */
    public function getCoursesAttribute(){
        $semesters = $this->program_semesters;
        $courses = new Collection();
        foreach($semesters as $semester){
            $sem = ProgramSemester::with('courses')->findOrFail($semester->id);
            foreach($sem->courses as $course){
                $courses->push($course);
            }
        }
        return $courses;
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function program_requirements(){
        return $this->hasMany(ProgramRequirement::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function program_semesters(){
        return $this->hasMany(ProgramSemester::class);
    }


    public function getCareerListAttribute(){
        return $this->careers()->lists('career_id')->all();
    }

    public function careers(){
        return $this->belongsToMany(Career::class,'career_program', 'program_id', 'career_id');
    }
}
