<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Brand;
use Carbon\Carbon;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call(UsersTableSeeder::class);
        $this->command->info('User table seeded!');

        $this->call(BrandsTableSeeder::class);
        $this->command->info('Brand table seeded!');

        $this->call(ProductsTableSeeder::class);
        $this->command->info('Products table seeded!');
    }
}

Class UsersTableSeeder extends Seeder {
    public function run()
    {
        DB::table('users')->delete();

        User::create(array(
            'email' => 'member@email.com',
            'password' => Hash::make('password'),
            'name' => 'John Doe',
            'admin' => 0
        ));

        User::create(array(
            'email' => 'admin@store.com',
            'password' => Hash::make('adminpassword'),
            'name' => 'Jennifer Taylor',
            'admin' => 1
        ));
    }
}

Class BrandsTableSeeder extends Seeder {
    public function run()
    {
        DB::table('brands')->delete();

        DB::table('brands')->insert([
            'brand_name' => 'Apple',
        ]);
        DB::table('brands')->insert([
            'brand_name' => 'SONY',
        ]);
        DB::table('brands')->insert([
            'brand_name' => 'Microsoft',
        ]);
        DB::table('brands')->insert([
            'brand_name' => 'LG',
        ]);
        DB::table('brands')->insert([
            'brand_name' => 'Astro Gaming',
        ]);
        DB::table('brands')->insert([
            'brand_name' => 'Samsung',
        ]);
        DB::table('brands')->insert([
            'brand_name' => 'DELL',
        ]);
        DB::table('brands')->insert([
            'brand_name' => 'HP',
        ]);
        DB::table('brands')->insert([
            'brand_name' => 'Turtle Beach',
        ]);

    }
}
Class ProductsTableSeeder extends Seeder {
    public function run()
    {
        DB::table('products')->insert([
            'product_name' => 'Xbox One - Turtle Beach X-40 Headset',
            'price'        =>  29.89,
            'brand_id'     => 1,
            'category_id'  => 1,
            'description'  => 'For work or play, this laptop offers 1TB of storage for digital photos, videos, music and more. The chiclet keyboard and HD display allow easy typing and navigation.'

        ]);
        DB::table('products')->insert([
            'product_name' => 'Xbox One - Elite Controller',
            'price'        =>  150.00,
            'brand_id'     => 2,
            'category_id'  => 2,
            'description'  => 'Combine incredible water resistance with a great screen and a powerful processor, and you get the Samsung Galaxy S7. It\'s built to withstand dunks in water for up to 30 minutes, and then you can wipe it off and get playing with a 5.1-inch touchscreen. The Samsung Galaxy S7 enjoys a quad-core processor for ultra-fast responsiveness.',

        ]);
        DB::table('products')->insert([
            'product_name' => 'Means Levi Jeans - Dark Blue',
            'price'        =>  59.89,
            'brand_id'     => 3,
            'category_id'  => 3,
            'description'  => 'Samsung UN65JU6700FXZA 4K Ultra HD TV: Enter the worlds of your favorite movies, TV shows and video games with this curved 4K TV that features automatic depth enhancement. The impressive display provides clear viewing angles and vivid colors, whether you are browsing the Web or mirroring content from your smartphone.',

        ]);
    }
}