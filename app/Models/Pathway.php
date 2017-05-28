<?php

namespace ProgramPlanner\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed program_id
 * @property mixed id
 */
class Pathway extends Model
{
    protected $table = 'pathways';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description','program_id'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];


    public $timestamps = false;


    public function getCoursesAttribute(){
        $semesters = $this->pathway_semesters;
        $courses = new Collection();
        foreach($semesters as $semester){
            $sem = PathwaySemester::with('courses')->findOrFail($semester->id);
            foreach($sem->courses as $course){
                $courses->push($course);
            }
        }
        return $courses;
    }

    public function program(){
        return $this->belongsTo(Program::class);
    }
    /**
     * A pathway can have multiple semesters.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pathway_semesters()
    {
        return $this->hasMany(PathwaySemester::class);
    }

    public function getCareerListAttribute(){
        return $this->careers()->lists('career_id')->all();
    }

    public function careers(){
        return $this->belongsToMany(Career::class,'career_pathway', 'pathway_id', 'career_id');
    }

    /**
     * Copies over course and semester data from program on first creation;
     */
    public function initializePathway(){
        $program = Program::with('program_semesters.courses')->findOrFail($this->program_id);

        foreach($program->program_semesters as $semester){
            $pathway_semester = PathwaySemester::create([
                'pathway_id' => $this->id,
                'semester_id' => $semester->semester_id,
                'name' => $semester->name,
                'order_number' => $semester->order_number
            ]);


            $pathway_semester->courses()->attach($semester->program_semester_course_list);
        }
    }

}
