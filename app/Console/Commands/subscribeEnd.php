<?php

namespace App\Console\Commands;

use App\Models\Subscribe;
use Illuminate\Console\Command;

class subscribeEnd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscribe:end';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email to user when subscribe before end';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $subscribes=Subscribe::all();
    foreach($subscribes as $sub){
$date=date('Y-m-d');
}
        
    }
}
