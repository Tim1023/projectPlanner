<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademicSemesterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('academic_semesters');
        Schema::create('academic_semesters', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('order_number')->unsigned()->default(0);
            $table->integer('semester_id')->unsigned();

            $table->foreign('semester_id')
                ->references('id')
                ->on('semesters')
                ->onDelete('restrict');

        });

        $start_date_sem_1 = \Carbon\Carbon::createFromDate(2012,3,1);
        $end_date_sem_1 = \Carbon\Carbon::createFromDate(2012,6,30);

        $start_date_sem_2 = \Carbon\Carbon::createFromDate(2012,8,1);
        $end_date_sem_2 = \Carbon\Carbon::createFromDate(2012,11,30);

        $start_date_summer = \Carbon\Carbon::createFromDate(2012,12,5);
        $end_date_summer = \Carbon\Carbon::createFromDate(2013,2,15);

        DB::table('academic_semesters')->insert([
            [
                'name' => 'Semester 1 - 2012',
                'start_date' => $start_date_sem_1->format('Y-m-d'),
                'end_date' => $end_date_sem_1->format('Y-m-d'),
                'order_number' => 1,
                'semester_id' => 1,
            ],
            [
                'name' => 'Semester 2 - 2012',
                'start_date' => $start_date_sem_2->format('Y-m-d'),
                'end_date' => $end_date_sem_2->format('Y-m-d'),
                'order_number' => 2,
                'semester_id' => 1,
            ],
            [
                'name' => 'Summer Semester - 2012',
                'start_date' => $start_date_summer->format('Y-m-d'),
                'end_date' => $end_date_summer->format('Y-m-d'),
                'order_number' => 3,
                'semester_id' => 2,
            ],
            [
                'name' => 'Semester 1 - 2013',
                'start_date' => $start_date_sem_1->addYear(1)->format('Y-m-d'),
                'end_date' => $end_date_sem_1->addYear(1)->format('Y-m-d'),
                'order_number' => 4,
                'semester_id' => 1,
            ],
            [
                'name' => 'Semester 2 - 2013',
                'start_date' => $start_date_sem_2->addYear(1)->format('Y-m-d'),
                'end_date' => $end_date_sem_2->addYear(1)->format('Y-m-d'),
                'order_number' => 5,
                'semester_id' => 1,
            ],
            [
                'name' => 'Summer Semester - 2013',
                'start_date' => $start_date_summer->addYear(1)->format('Y-m-d'),
                'end_date' => $end_date_summer->addYear(1)->format('Y-m-d'),
                'order_number' => 6,
                'semester_id' => 2,
            ],
            [
                'name' => 'Semester 1 - 2014',
                'start_date' => $start_date_sem_1->addYear(1)->format('Y-m-d'),
                'end_date' => $end_date_sem_1->addYear(1)->format('Y-m-d'),
                'order_number' => 7,
                'semester_id' => 1,
            ],
            [
                'name' => 'Semester 2 - 2014',
                'start_date' => $start_date_sem_2->addYear(1)->format('Y-m-d'),
                'end_date' => $end_date_sem_2->addYear(1)->format('Y-m-d'),
                'order_number' => 8,
                'semester_id' => 1,
            ],
            [
                'name' => 'Summer Semester - 2014',
                'start_date' => $start_date_summer->addYear(1)->format('Y-m-d'),
                'end_date' => $end_date_summer->addYear(1)->format('Y-m-d'),
                'order_number' => 9,
                'semester_id' => 2,
            ],
            [
                'name' => 'Semester 1 - 2015',
                'start_date' => $start_date_sem_1->addYear(1)->format('Y-m-d'),
                'end_date' => $end_date_sem_1->addYear(1)->format('Y-m-d'),
                'order_number' => 10,
                'semester_id' => 1,
            ],
            [
                'name' => 'Semester 2 - 2015',
                'start_date' => $start_date_sem_2->addYear(1)->format('Y-m-d'),
                'end_date' => $end_date_sem_2->addYear(1)->format('Y-m-d'),
                'order_number' => 11,
                'semester_id' => 1,
            ],
            [
                'name' => 'Summer Semester - 2015',
                'start_date' => $start_date_summer->addYear(1)->format('Y-m-d'),
                'end_date' => $end_date_summer->addYear(1)->format('Y-m-d'),
                'order_number' => 12,
                'semester_id' => 2,
            ],
            [
                'name' => 'Semester 1 - 2016',
                'start_date' => $start_date_sem_1->addYear(1)->format('Y-m-d'),
                'end_date' => $end_date_sem_1->addYear(1)->format('Y-m-d'),
                'order_number' => 13,
                'semester_id' => 1,
            ],
            [
                'name' => 'Semester 2 - 2016',
                'start_date' => $start_date_sem_2->addYear(1)->format('Y-m-d'),
                'end_date' => $end_date_sem_2->addYear(1)->format('Y-m-d'),
                'order_number' => 14,
                'semester_id' => 1,
            ],
            [
                'name' => 'Summer Semester - 2016',
                'start_date' => $start_date_summer->addYear(1)->format('Y-m-d'),
                'end_date' => $end_date_summer->addYear(1)->format('Y-m-d'),
                'order_number' => 15,
                'semester_id' => 2,
            ],
            [
                'name' => 'Semester 1 - 2017',
                'start_date' => $start_date_sem_1->addYear(1)->format('Y-m-d'),
                'end_date' => $end_date_sem_1->addYear(1)->format('Y-m-d'),
                'order_number' => 16,
                'semester_id' => 1,
            ],
            [
                'name' => 'Semester 2 - 2017',
                'start_date' => $start_date_sem_2->addYear(1)->format('Y-m-d'),
                'end_date' => $end_date_sem_2->addYear(1)->format('Y-m-d'),
                'order_number' => 17,
                'semester_id' => 1,
            ],
            [
                'name' => 'Summer Semester - 2017',
                'start_date' => $start_date_summer->addYear(1)->format('Y-m-d'),
                'end_date' => $end_date_summer->addYear(1)->format('Y-m-d'),
                'order_number' => 18,
                'semester_id' => 2,
            ],
            [
                'name' => 'Semester 1 - 2018',
                'start_date' => $start_date_sem_1->addYear(1)->format('Y-m-d'),
                'end_date' => $end_date_sem_1->addYear(1)->format('Y-m-d'),
                'order_number' => 19,
                'semester_id' => 1,
            ],
            [
                'name' => 'Semester 2 - 2018',
                'start_date' => $start_date_sem_2->addYear(1)->format('Y-m-d'),
                'end_date' => $end_date_sem_2->addYear(1)->format('Y-m-d'),
                'order_number' => 20,
                'semester_id' => 1,
            ],
            [
                'name' => 'Summer Semester - 2018',
                'start_date' => $start_date_summer->addYear(1)->format('Y-m-d'),
                'end_date' => $end_date_summer->addYear(1)->format('Y-m-d'),
                'order_number' => 21,
                'semester_id' => 2,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_semesters');
    }
}
