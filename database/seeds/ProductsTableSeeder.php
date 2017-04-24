<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

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
        $faker = Faker\Factory::create(\App\Product::class);

        foreach(range(1,12) as $index){
            $type = rand(0,1);
            if($type == 0){ //auction
                DB::table('products')->insert([
                    'user_id' => rand(2,5),
                    'title' => $faker->text(15),
                    'type' => $type,
                    'description' => $faker->text(200),
                    'expirationDate' => $faker->dateTimeBetween($date, $date->addWeek()),
                    'startingBid' => $faker->randomFloat(2, 0.50, 250),
                    'mailingService_id' => rand(1,5),
                    //JEIGU ANT LAPTOPO
                    //'picture' => substr($faker->image($dir = public_path(). '/products/'), 22),
                    //JEIGU ANT STALINIO
                    'picture' => substr($faker->image($dir = public_path(). '/products/'), 38),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            }else{  //regular item
                DB::table('products')->insert([
                    'user_id' => rand(2,5),
                    'title' => $faker->text(15),
                    'type' => $type,
                    'description' => $faker->text(200),
                    'quantity' => rand(1,25),
                    'price' => $faker->randomFloat(2,0.50,250),
                    'mailingService_id' => rand(1,5),
                    //JEIGU ANT LAPTOPO
                    //'picture' => substr($faker->image($dir = public_path(). '/products/'), 22),
                    //JEIGU ANT STALINIO
                    'picture' => substr($faker->image($dir = public_path(). '/products/'), 38),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            }
        }

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
