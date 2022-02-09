<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeleProvider;

class TeleProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            (object) [
                'name' => 'XL',
            ],
            (object) [
                'name' => 'Telkomsel',
            ],
            (object) [
                'name' => 'Tri',
            ],
            (object) [
                'name' => 'Smartfren',
            ],
            (object) [
                'name' => 'Indosat',
            ],
            (object) [
                'name' => 'By.U',
            ],
        ];

        foreach ($data as $item) {
            TeleProvider::create([
                "name" => $item->name,
            ]);
        }
    }
}
