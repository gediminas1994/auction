<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class productsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::create(2017, 4, 16, 0, 0, 0);

        DB::table('products')->insert([
            'user_id' => 3,
            'title' => str_random(),
            'type' => rand(0,1),
            'description' => str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => rand(101, 9999) / 100,
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Beauty And The Beast 2017.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => 3,
            'title' => str_random(),
            'type' => rand(0,1),
            'description' => str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => rand(101, 9999) / 100,
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Doctor Strange 2016.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => 3,
            'title' => str_random(),
            'type' => rand(0,1),
            'description' => str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => rand(101, 9999) / 100,
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Grant Budapest Hotel 2014.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => 3,
            'title' => str_random(),
            'type' => rand(0,1),
            'description' => str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => rand(101, 9999) / 100,
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Hot Rod 2017.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => rand(2,11),
            'title' => str_random(),
            'type' => rand(0,1),
            'description' => str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => rand(101, 9999) / 100,
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Kong Skull Island 2017.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => rand(2,11),
            'title' => str_random(),
            'type' => rand(0,1),
            'description' => str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => rand(101, 9999) / 100,
            'mailingService_id' => rand(1,5),
            'picture' => '/products/La La Land 2016.jpeg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => rand(2,11),
            'title' => str_random(),
            'type' => rand(0,1),
            'description' => str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => rand(101, 9999) / 100,
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Liar Liar 1997.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => rand(2,11),
            'title' => str_random(),
            'type' => rand(0,1),
            'description' => str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => rand(101, 9999) / 100,
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Lion 2016.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => rand(2,11),
            'title' => str_random(),
            'type' => rand(0,1),
            'description' => str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => rand(101, 9999) / 100,
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Logan 2017.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => rand(2,11),
            'title' => str_random(),
            'type' => rand(0,1),
            'description' => str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => rand(101, 9999) / 100,
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Mirror Mirror 2012.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => rand(2,11),
            'title' => str_random(),
            'type' => rand(0,1),
            'description' => str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => rand(101, 9999) / 100,
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Moana 2016.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => rand(2,11),
            'title' => str_random(),
            'type' => rand(0,1),
            'description' => str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => rand(101, 9999) / 100,
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Reservoir Dogs 1992.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => rand(2,11),
            'title' => str_random(),
            'type' => rand(0,1),
            'description' => str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => rand(101, 9999) / 100,
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Split 2017.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => rand(2,11),
            'title' => str_random(),
            'type' => rand(0,1),
            'description' => str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)) . ' ' . str_random(rand(0,20)),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => rand(101, 9999) / 100,
            'mailingService_id' => rand(1,5),
            'picture' => '/products/The Guest 2014.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);


        $products = \App\Product::all();

        foreach ($products as $product) {
            $category = \App\Category::inRandomOrder()->first();

            $category->products()->attach($product);

        }
    }
}
