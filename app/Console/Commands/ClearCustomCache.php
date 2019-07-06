<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ClearCustomCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:custom';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears the cache for e.g. HTML purifier and cached images.';

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
     * @return mixed
     */
    public function handle()
    {
        $FileSystem = new Filesystem();
        $FileSystem->cleanDirectory(storage_path('app/purifier'));
        $FileSystem->cleanDirectory(public_path('cache'));
    }
}
