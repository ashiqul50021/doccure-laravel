<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ensure we have categories
        $categories = ProductCategory::all();

        if ($categories->isEmpty()) {
            $cat1 = ProductCategory::create(['name' => 'Medicine', 'slug' => 'medicine', 'is_active' => true]);
            $cat2 = ProductCategory::create(['name' => 'Healthcare', 'slug' => 'healthcare', 'is_active' => true]);
            $cat3 = ProductCategory::create(['name' => 'Devices', 'slug' => 'devices', 'is_active' => true]);
            $categories = collect([$cat1, $cat2, $cat3]);
        }

        $products = [
            [
                'name' => 'Napa Extra 500mh',
                'category_slug' => 'medicine',
                'price' => 30.00,
                'sale_price' => 25.00,
                'description' => 'Effective for fever and pain relief. Contains Paracetamol 500mg and Caffeine 65mg.',
                'stock' => 100,
                'is_featured' => true,
            ],
            [
                'name' => 'Seclo 20mg Capsule',
                'category_slug' => 'medicine',
                'price' => 70.00,
                'sale_price' => null, // No discount
                'description' => 'Omeprazole 20mg for gastric and acidity problems.',
                'stock' => 200,
                'is_featured' => true,
            ],
            [
                'name' => 'Savlon Antiseptic Liquid',
                'category_slug' => 'healthcare',
                'price' => 120.00,
                'sale_price' => 100.00,
                'description' => 'Trusted antiseptic liquid for first aid and personal hygiene.',
                'stock' => 50,
                'is_featured' => true,
            ],
            [
                'name' => 'Digital Thermometer',
                'category_slug' => 'devices',
                'price' => 250.00,
                'sale_price' => 190.00,
                'description' => 'Accurate digital thermometer for measuring body temperature.',
                'stock' => 30,
                'is_featured' => true,
            ],
            [
                'name' => 'Monas 10mg Tablet',
                'category_slug' => 'medicine',
                'price' => 160.00,
                'sale_price' => 150.00,
                'description' => 'Montelukast Sodium 10mg for asthma and allergy relief.',
                'stock' => 150,
                'is_featured' => false,
            ],
            [
                'name' => 'KN95 Face Mask (Pack of 5)',
                'category_slug' => 'healthcare',
                'price' => 100.00,
                'sale_price' => 80.00,
                'description' => 'High protection KN95 face masks for daily use.',
                'stock' => 500,
                'is_featured' => true,
            ],
            [
                'name' => 'Pulse Oximeter',
                'category_slug' => 'devices',
                'price' => 1200.00,
                'sale_price' => 950.00,
                'description' => 'Finger tip pulse oximeter for measuring oxygen saturation.',
                'stock' => 20,
                'is_featured' => true,
            ],
            [
                'name' => 'Vitamin C 500mg',
                'category_slug' => 'medicine',
                'price' => 150.00,
                'sale_price' => 120.00,
                'description' => 'Boosts immunity and helps in quick recovery.',
                'stock' => 300,
                'is_featured' => true,
            ],
            [
                'name' => 'Hand Sanitizer 200ml',
                'category_slug' => 'healthcare',
                'price' => 180.00,
                'sale_price' => null,
                'description' => 'Alcohol based hand sanitizer kills 99.9% germs.',
                'stock' => 100,
                'is_featured' => false,
            ],
            [
                'name' => 'Glucometer Kit',
                'category_slug' => 'devices',
                'price' => 1500.00,
                'sale_price' => 1200.00,
                'description' => 'Complete kit for checking blood sugar levels at home.',
                'stock' => 15,
                'is_featured' => true,
            ],
        ];

        foreach ($products as $prod) {
            $category = $categories->where('slug', $prod['category_slug'])->first();
            if (!$category) {
                // Fallback to first category if slug match fails
                $category = $categories->first();
            }

            Product::create([
                'name' => $prod['name'],
                'slug' => Str::slug($prod['name']),
                'product_category_id' => $category->id,
                // Removed brand_name as column does not exist
                'price' => $prod['price'],
                'sale_price' => $prod['sale_price'],
                'description' => $prod['description'],
                'stock' => $prod['stock'],
                'is_featured' => $prod['is_featured'],
                'is_active' => true,
                'image' => null,
            ]);
        }

        // Seed Doctor Specialities if needed
        $specialities = [
            'Cardiology',
            'Neurology',
            'Orthopedic',
            'Dentist',
            'Urology',
            'MRI Scans',
            'Pediatrics',
            'Gynecology'
        ];

        foreach ($specialities as $spName) {
            if (!\App\Models\Speciality::where('name', $spName)->exists()) {
                \App\Models\Speciality::create([
                    'name' => $spName,
                    'slug' => Str::slug($spName),
                    'description' => "Specialist in $spName",
                    'is_active' => true,
                    'image' => null
                ]);
            }
        }
    }
}
