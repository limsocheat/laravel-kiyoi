<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Product::class, 5)->create()->each(function($product) {
        	$order_item = factory(\App\OrderItem::class)->create();
        	$product->order_item()->save($order_item);
        });
        // factory(\App\Product::class, 5)->create();
    }
}
