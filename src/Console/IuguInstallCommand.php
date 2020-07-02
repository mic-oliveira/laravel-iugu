<?php


namespace Iugu\Console;


use Illuminate\Console\Command;

class IuguInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iugu:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate Iugu';

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
        //
        $this->call('migrate:fresh', ['--database'=>config('iugu.connection'), '--path'=>'/vendor/michaelferreira/iugu-laravel/database/migrations']);
    }
}
