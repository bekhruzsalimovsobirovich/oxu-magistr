<?php

namespace Database\Seeders;

use App\Domain\Specialities\Models\Speciality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialities = [
            'Ta\'limda axborot texnologiyalari',
            'Xorijiy til va adabiyoti (tillar bo\'yicha)',
            'Jismoniy tarbiya va sport mashg\'ulotlari nazariyasi va metodikasi',
            'Iqtisodiyot',
            'Pedagogika',
            'Psixologiya'
        ];

        foreach ($specialities as $speciality){
            $spc = new Speciality();
            $spc->name = $speciality;
            $spc->save();
        }
    }
}
