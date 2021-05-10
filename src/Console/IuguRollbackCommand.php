<?php


namespace Iugu\Console;


use Illuminate\Console\Command;

class IuguRollbackCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iugu:install
                            {--rollback : faz rollback de migrations}';

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
        if($this->option('rollback'))
        {
            $this->call('migrate:rollback',
                [
                    '--database'=>config('iugu.connection'),
                    '--path'=>'/vendor/michaelferreira/iugu-laravel/database/migrations'
                ]
            );
        }
    }
}
