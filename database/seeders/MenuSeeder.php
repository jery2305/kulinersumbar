<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
    {
        Menu::create([
            'name' => 'Rendang',
            'description' => 'Daging sapi berbumbu rempah kaya rasa',
            'price' => 25000,
            'image' => 'rendang.jpg',
        ]);

        Menu::create([
            'name' => 'Sate Padang',
            'description' => 'Sate daging sapi dengan kuah kental khas Minang',
            'price' => 20000,
            'image' => 'sate-padang.jpg',
        ]);

        Menu::create([
            'name' => 'Dendeng Balado',
            'description' => 'Daging sapi iris tipis dengan sambal balado pedas',
            'price' => 30000,
            'image' => 'dendeng-balado.jpg',
        ]);
    }
}
