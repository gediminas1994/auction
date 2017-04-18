<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        DB::table('categories')->insert([
        	'title' => 'Electronics',
            'parent_id' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
        	'title' => 'Cell Phones & Accessories',
            'parent_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
        	'title' => 'Cameras & Photo',
            'parent_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
        	'title' => 'Computers & tablets',
            'parent_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //5
        DB::table('categories')->insert([
        	'title' => 'Home & Garden',
            'parent_id' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
        	'title' => 'Electronics',
            'parent_id' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
        	'title' => 'Home Improvement',
            'parent_id' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
        	'title' => 'Tools',
            'parent_id' => 5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //9
        DB::table('categories')->insert([
        	'title' => 'Sporting Goods',
            'parent_id' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
        	'title' => 'Cycling',
            'parent_id' => 9,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
        	'title' => 'Golf',
            'parent_id' => 9,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
        	'title' => 'Hunting',
            'parent_id' => 9,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //13
        DB::table('categories')->insert([
        	'title' => 'Motors',
            'parent_id' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
        	'title' => 'Cars & Trucks',
            'parent_id' => 13,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
        	'title' => 'Motorcycles',
            'parent_id' => 13,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
        	'title' => 'Parts & Accessories',
            'parent_id' => 13,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        //17
        DB::table('categories')->insert([
        	'title' => 'Fashion',
            'parent_id' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('categories')->insert([
        	'title' => "Men's",
            'parent_id' => 17,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
        	'title' => "Women's",
            'parent_id' => 17,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('categories')->insert([
        	'title' => 'Kids',
            'parent_id' => 17,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
