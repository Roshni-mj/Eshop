<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Image;
use App\Models\Payment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $products = Product::factory(30)->create();
        $cart = Cart::factory(10)->create();
        $image = Image::factory(16)->create();
        $order = Order::factory(10)->create();
        $payment = Payment::factory(10)->create();
        $user = User::factory(20)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
