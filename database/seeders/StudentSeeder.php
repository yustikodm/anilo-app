<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    private $students = [
        [
            'id' => 1001,
            'name' => 'agus'
        ],
        [
            'id' => 1002,
            'name' => 'budi'
        ],
        [
            'id' => 1003,
            'name' => 'deni'
        ],
        [
            'id' => 1004,
            'name' => 'riko'
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
            $student = new Student();
            $student->fill($value);
            $student->save();
        }
    }
}
