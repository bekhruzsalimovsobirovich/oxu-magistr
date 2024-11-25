<?php

namespace Database\Seeders;

use App\Domain\Buildings\Models\Building;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buildings = [1,2,3,4,5];

        foreach ($buildings as $building){
            $bdg = new Building();
            $bdg->name = $building;
            $bdg->save();
        }
    }
}
