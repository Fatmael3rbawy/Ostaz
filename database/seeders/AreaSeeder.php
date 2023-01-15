<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->delete();

        $areas = [
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
            'elgalaa',
            'elmahala',
            'elgeish',
            'elteraa',
            'sandoob',
            'samaa elgamal',
            'hay elgamaa',
            
        ];

        foreach ($areas as $area){
            Area::create([
                'area' => $area,
                'city_id' => City::all()->unique()->random()->id,
            ]);
        }
    }
}
