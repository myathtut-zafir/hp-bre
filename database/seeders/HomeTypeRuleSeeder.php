<?php

namespace Database\Seeders;

use App\Models\HomeType;
use Illuminate\Database\Seeder;

class HomeTypeRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $firstHomeCategory = [
            'mini-condo',
            'condo',
            'apartment',
            'private house',
            'shop',
            'land',
        ];

        $secondHomeCategory = [
            'zone_land'];

        $homeTypes = HomeType::all();
        foreach ($homeTypes as $homeType) {
            if (in_array($homeType->type, $firstHomeCategory)) {
                $homeType->rules()->sync([
                    1, 2, 3, 4, 5, 6, 7, 8,
                ]);
            } elseif (in_array($homeType->type, $secondHomeCategory, true)) {
                $homeType->rules()->sync([
                    9,
                ]);
            }
        }
    }
}
