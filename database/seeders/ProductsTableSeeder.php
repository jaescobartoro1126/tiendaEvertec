<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            if(Product::count() === 0) {
                $data = [
                    [
                        'name'=>'Product 1',
                        'status'=> 'active',
                        'value' => 100000,
                        'url' => 'product1.jpg'
                    ],
                    [
                        'name'=>'Product 2',
                        'status'=> 'active',
                        'value' => 200000,
                        'url' => 'product2.jpg'
                    ]
                ];
                Product::insert($data);
            }
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
