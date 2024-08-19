<?php

namespace App\Console\Commands;
use App\Models\Cart;
use Illuminate\Console\Command;

class RemoveOldCarts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'carts:remove-old {--days=7 : the days after which the carts will be removed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove old carts based on a given days.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deadline = now()->subDays($this->option('days'));
        $counter = Cart::whereDate('updated_at','<=',$deadline)->delete();
        $this->info("Done! {$counter} carts where removed.");
    }
}
