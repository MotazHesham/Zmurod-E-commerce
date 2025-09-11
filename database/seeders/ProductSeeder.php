<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // You can adjust the number of products you want to create here
        $numberOfProducts = 6;

        // Define the shipping methods
        $shippingMethods = ['seller', 'hrayer'];

        for ($i = 1; $i <= $numberOfProducts; $i++) {
            $product = Product::create([
                'name' => "Product {$i}",
                'current_stock' => rand(10, 100),
                'information' => "Information for Product {$i}",
                'most_recent' => 1,
                'fav'=> 1 ,
                'published' => 1,
                'discount' => null, // You can adjust the range of discount here
                'price' => rand(50, 500), // You can adjust the range of price here
                'product_category_id' => Category::inRandomOrder()->first()->id,
                'user_id' => null, // null means that product refer to the admin
                'shipping_method' => $shippingMethods[array_rand($shippingMethods)],
            ]);
            // Upload the product image if file exists
            $imagePath = public_path('assets/images/product-image/'.$i.'.jpg');
            if (file_exists($imagePath)) {
                // Copy file to tmp directory first
                $tmpPath = storage_path('tmp/uploads/product_' . $i . '.jpg');
                if (!file_exists(storage_path('tmp/uploads'))) {
                    mkdir(storage_path('tmp/uploads'), 0755, true);
                }
                copy($imagePath, $tmpPath);
                
                $product->addMedia($tmpPath)
                    ->toMediaCollection('image');
            }
        
        }
    }
}
