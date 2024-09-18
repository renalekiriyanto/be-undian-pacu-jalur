<?php

namespace Database\Seeders;

use App\Models\Round;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Putaran Pertama'
            ],
            [
                'name' => 'Putaran Kedua'
            ],
            [
                'name' => 'Semi Final'
            ],
            [
                'name' => 'Perebutan 3 & 4'
            ],
            [
                'name' => 'Final'
            ]
        ];

        foreach ($data as $item) {
            Round::create([
                'name' => $item['name'],
                'slug' => Str::slug($item['name'])
            ]);
        }
    }
}
