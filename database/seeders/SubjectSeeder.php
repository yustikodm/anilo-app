<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    private $students = [
        [
            'id' => 1001,
            'name' => 'Algoritma'
        ],
        [
            'id' => 1002,
            'name' => 'Pemrograman Dasar'
        ],
        [
            'id' => 1003,
            'name' => 'Basis Data'
        ],
        [
            'id' => 1004,
            'name' => 'Matematika Dasar'
        ],
        [
            'id' => 1005,
            'name' => 'Teknik Digital'
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
            $student = new Subject();
            $student->fill($value);
            $student->save();
        }
    }
}
