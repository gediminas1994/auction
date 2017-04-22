<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();
        $faker = Faker::create(\App\Product::class);

        DB::table('products')->insert([
            'user_id' => 3,
            'title' => $faker->text(15),
            'type' => rand(0,1),
            'description' => $faker->text(200),
            'expirationDate' => $faker->dateTimeBetween($date, $date->addWeek()),
            'quantity' => rand(1,25),
            'startingBid' => $faker->randomFloat(2, 0.50, 250),
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Beauty And The Beast 2017.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => 3,
            'title' => $faker->text(15),
            'type' => rand(0,1),
            'description' => $faker->text(200),
            'expirationDate' => $faker->dateTimeBetween($date, $date->addWeek()),
            'quantity' => rand(1,25),
            'startingBid' => $faker->randomFloat(2, 0.50, 250),
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Doctor Strange 2016.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => 3,
            'title' => $faker->text(15),
            'type' => rand(0,1),
            'description' => $faker->text(200),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => $faker->randomFloat(2, 0.50, 250),
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Grant Budapest Hotel 2014.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => 3,
            'title' => $faker->text(15),
            'type' => rand(0,1),
            'description' => $faker->text(200),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => $faker->randomFloat(2, 0.50, 250),
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Hot Rod 2017.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => rand(2,11),
            'title' => $faker->text(15),
            'type' => rand(0,1),
            'description' => $faker->text(200),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => $faker->randomFloat(2, 0.50, 250),
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Kong Skull Island 2017.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => rand(2,11),
            'title' => $faker->text(15),
            'type' => rand(0,1),
            'description' => $faker->text(200),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => $faker->randomFloat(2, 0.50, 250),
            'mailingService_id' => rand(1,5),
            'picture' => '/products/La La Land 2016.jpeg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => rand(2,11),
            'title' => $faker->text(15),
            'type' => rand(0,1),
            'description' => $faker->text(200),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => $faker->randomFloat(2, 0.50, 250),
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Liar Liar 1997.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => rand(2,11),
            'title' => $faker->text(15),
            'type' => rand(0,1),
            'description' => $faker->text(200),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => $faker->randomFloat(2, 0.50, 250),
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Lion 2016.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => rand(2,11),
            'title' => $faker->text(15),
            'type' => rand(0,1),
            'description' => $faker->text(200),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => $faker->randomFloat(2, 0.50, 250),
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Logan 2017.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => rand(2,11),
            'title' => $faker->text(15),
            'type' => rand(0,1),
            'description' => $faker->text(200),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => $faker->randomFloat(2, 0.50, 250),
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Mirror Mirror 2012.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => rand(2,11),
            'title' => $faker->text(15),
            'type' => rand(0,1),
            'description' => $faker->text(200),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => $faker->randomFloat(2, 0.50, 250),
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Moana 2016.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => rand(2,11),
            'title' => $faker->text(15),
            'type' => rand(0,1),
            'description' => $faker->text(200),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => $faker->randomFloat(2, 0.50, 250),
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Reservoir Dogs 1992.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => rand(2,11),
            'title' => $faker->text(15),
            'type' => rand(0,1),
            'description' => $faker->text(200),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => $faker->randomFloat(2, 0.50, 250),
            'mailingService_id' => rand(1,5),
            'picture' => '/products/Split 2017.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'user_id' => rand(2,11),
            'title' => $faker->text(15),
            'type' => rand(0,1),
            'description' => $faker->text(200),
            'expirationDate' => $date->addHours(rand(1, 72))->format('Y-m-d H:i:s'),
            'quantity' => rand(1,25),
            'startingBid' => $faker->randomFloat(2, 0.50, 250),
            'mailingService_id' => rand(1,5),
            'picture' => '/products/The Guest 2014.jpg',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);


        $products = \App\Product::all();

        foreach ($products as $product) {
            $category = \App\Category::inRandomOrder()
                ->where('id', '!=', 1)
                ->where('id', '!=', 5)
                ->where('id', '!=', 9)
                ->where('id', '!=', 13)
                ->where('id', '!=', 17)
                ->first();

            $category->products()->attach($product);

        }
    }
}
