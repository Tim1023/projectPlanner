<?php

namespace ProgramPlanner\Models;

use Illuminate\Database\Eloquent\Model;
use ProgramPlanner\Enums\Level;

/**
 * @property mixed id
 */
class Course extends Model
{
    protected $table = 'courses';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'course_number', 'credits', 'level', 'department_id'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];


    /**
     * The custom attributes defined in this model
     */
    protected $appends = ['level_name', 'credit_points', 'career_list'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Returns the Level in string Format
     * @return string
     */
    public function getLevelNameAttribute()
    {
        $this->attributes['level_name'] = 'Level ' . $this->attributes['level'];
        return ucfirst($this->attributes['level_name']);
    }

    public function getFullNameAttribute()
    {
        $this->attributes['full_name'] = $this->attributes['course_number'] . ' - ' . $this->attributes['name'];
        return ucfirst($this->attributes['full_name']);
    }

    public function getFullNameWithCreditsAttribute()
    {
        $this->attributes['full_name_with_credits'] = $this->attributes['course_number'] . ' - ' . $this->attributes['name'] . ' - ' . $this->attributes['credits'] . ' Credit Points';
        return ucfirst($this->attributes['full_name_with_credits']);
    }
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
     * Fake attribute used to check if a course is compulsory or not in programs
     *
     * @return bool
     */
    public function getIsCompulsoryAttribute(){
        $this->attributes['is_compulsory'] = false;
        return (bool)$this->attributes['is_compulsory'];
    }

    /**
     * @return mixed
     */
    public function getPreRequisiteListAttribute(){
        return $this->pre_requisites()->lists('pre_requisite_id')->all();
    }

    public function getCoRequisiteListAttribute(){
        return $this->co_requisites()->lists('co_requisite_id')->all();
    }
    /**
     * Finds and returns the list of pre requisite courses for this course
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pre_requisites(){
        return $this->belongsToMany(Course::class,'pre_requisites', 'course_id', 'pre_requisite_id');
    }

    /**
     * Finds and returns the list of co requisite courses for this course
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function co_requisites(){
        return $this->belongsToMany(Course::class,'co_requisites', 'course_id','co_requisite_id');
    }

    /**
     * Finds and returns the list of courses which have this course as a pre requisite
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pre_requisite_of(){
        return $this->belongsToMany(Course::class,'pre_requisites','pre_requisite_id', 'course_id');
    }


    /**
     * Finds and returns the list of courses which have this course as a co requisite
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function co_requisite_of(){
        return $this->belongsToMany(Course::class,'co_requisites', 'co_requisite_id', 'course_id');
    }

    public function getCareerListAttribute(){
        return $this->careers()->lists('career_id')->all();
    }

    public function careers(){
        return $this->belongsToMany(Career::class,'career_course', 'course_id', 'career_id');
    }

    /**
     * Is supposed to find out the complete tree map in terms of pre-requisites and
     * co-requisites for this particular course
     * So returns the pre-requisites of this course, and follows the chain down to find
     * all the pre-requisites of that particular course.
     *
     * Will require a recursive loop using the belongsToMany methods defined above
     * Ideally this should be done at the database level using a stored proc to reduce the
     * number of queries
     */
    public function course_tree_map(){
        throwException(new \Exception("Not Implemented"));
    }
}
