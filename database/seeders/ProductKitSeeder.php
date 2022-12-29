<?php

namespace Database\Seeders;

use App\Models\Kit;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductKitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory(40)->create();
        Kit::factory(200)->create();
    }
}
