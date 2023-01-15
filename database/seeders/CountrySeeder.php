<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        $cities = [ "Cairo" , "Giza" , "Alexandria" , "Madinat as Sadis min Uktubar","Shubra al Khaymah" , "Al Mansurah", "Helwan" , "Al Mahallah al Kubra", "Port Said" , "Suez" , "Tanta",
        "Asyut" , "Al Fayoum", "Al Zaqaziq" , "Ismailia" , "Aswan" , "Kafr ad Dawwar", "Damanhur" , "Al Minya" , "Damietta",
        "Luxor" , "Qina" , "Suhaj" , "Bani Suwayf" , "Shibin al Kawm", "Al Arish","Al Ghardaqah", "Banha", "Kafr ash Shaykh" , "Disuq",
        "Bilbays" , "Mallawi" , "Idfu", "Mit Ghamr", "Munuf", "Jirja", "Akhmim", "Zifta", "Samalut", "Manfalut", "Bani Mazar",
        "Armant", "Maghaghah" , "Kawm Umbu" , "Bur Foaud", "Al Qusiyah","Rosetta", "Isna","Matruh", "Abnub" , "Hihya","Samannud",
        "Dandarah", "Al Kharjah" , "Al Balyana" , "Matay","Naj‘ Hammadi", "San al Hajar al Qibliyah", "Dayr Mawas", "Ihnasya al Madinah",
        "Daraw", "Abu Qir", "Faraskur","Ra’s Gharib", "Al Husayniyah","Safaja", "Qiman al ‘Arus","Qaha", "Al Karnak", "Hirriyat Raznah","Al Qusayr","Kafr Shukr", "Siwah", "Kafr Sa‘d", "Sharunah", "At Tur", "Rafah" , "Ash Shaykh Zuwayd" , "Sinah"];
        
        $country = Country::create([
            'name' => 'Egypt',
        ]);

        foreach($cities as $city){
            City::create([
                'name' => $city,
                'country_id' => $country->id
            ]);
        }
        
    }
}