<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\AddressService;

class AddressCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-addresses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to update addresses';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->updateAddresses();
    }
}
