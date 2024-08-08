<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('orders')->insert([
            [
                'status' => 'pending',
                'customer_id' => 1, // Ensure that this customer_id exists in the users table
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 'completed',
                'customer_id' => 2, // Ensure that this customer_id exists in the users table
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'status' => 'shipped',
                'customer_id' => 3, // Ensure that this customer_id exists in the users table
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('orders')->whereIn('status', ['pending', 'completed', 'shipped'])->delete();
    }
};
