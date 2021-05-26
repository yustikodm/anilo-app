<?php

namespace Database\Seeders;

use App\Models\Score;
use Illuminate\Database\Seeder;

class ScoreSeeder extends Seeder
{
    private $students = [
        [
            'id' => 1,
            'student_id' => 1001,
            'subject_id' => 1002,
            'score' => 76
        ],
        [
            'id' => 2,
            'student_id' => 1002,
            'subject_id' => 1003,
            'score' => 60
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->students as $value) {
            $student = new Score();
            $student->fill($value);
            $student->save();
        }
    }
}
