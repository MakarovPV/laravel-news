<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class LoadData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Выполнение всех стартовых операций';

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
        Artisan::call('key:generate');

        Artisan::call('create:database');
        Artisan::call('migrate');
        Artisan::call('db:seed');

        Artisan::call('schedule:work');

        echo 'Все данные загружены.' . PHP_EOL;
    }
}
