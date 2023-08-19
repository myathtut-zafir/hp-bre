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
            'min-condo',
            'condo',
            'apartment',
            'private house',
            'shop',
            'land',
        ];

        $secondHomeCategory = [
            'zone-land', 'shop'];
        $otherHomeCategory = ['Other'];

        $homeTypes = HomeType::all();
        foreach ($homeTypes as $homeType) {
            if (in_array($homeType->type, $firstHomeCategory)) {
                $homeType->rules()->sync([
                    1, 2, 3, 4, 5, 6, 7, 8,
                ]);
            }
        }
    }
}
