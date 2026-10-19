<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Field;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    

public function run(): void
{
    Field::create([
        'name' => 'Arena Futsal Senayan',
        'category' => 'Futsal',
        'location' => 'Pekanbaru',
        'description' => 'Lapangan futsal untuk latihan dan bermain bersama teman.',
        'image' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=1200&q=85',
        'price_per_hour' => 150000,
        'facilities' => ['Area parkir', 'Toilet', 'Ruang ganti', 'Penerangan'],
    ]);

    Field::create([
        'name' => 'GOR Badminton Cendana',
        'category' => 'Badminton',
        'location' => 'Pekanbaru',
        'description' => 'Lapangan badminton untuk latihan dan permainan bersama.',
        'image' => 'https://images.unsplash.com/photo-1626224583764-f87db24ac4ea?auto=format&fit=crop&w=1200&q=85',
        'price_per_hour' => 80000,
        'facilities' => ['Area parkir', 'Toilet', 'Tempat duduk'],
    ]);

    Field::create([
        'name' => 'Basket Court Pekanbaru',
        'category' => 'Basket',
        'location' => 'Pekanbaru',
        'description' => 'Lapangan basket untuk latihan dan pertandingan.',
        'image' => 'https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&w=1200&q=85',
        'price_per_hour' => 120000,
        'facilities' => ['Area parkir', 'Toilet', 'Penerangan'],
    ]);
}
}
