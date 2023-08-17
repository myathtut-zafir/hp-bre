<?php

namespace Database\Seeders;

use App\Models\HomeType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rules = [
            [
                "type" => "min-condo"
            ], [
                "type" => "condo"
            ], [
                "type" => "apartment"
            ], [
                "type" => "private house"
            ], [
                "type" => "shop"
            ], [
                "type" => "land"
            ], [
                "type" => "zone land"
            ],
        ];

        DB::table("home_types")->truncate();
        foreach ($rules as $key => $value) {
            HomeType::create([
                'type' => $value['type'],
            ]);
        }
    }
}
