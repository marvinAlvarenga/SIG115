<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Marquine\Etl\Etl;

class EtlAuto extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'etl:auto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ejecuta los procesos del ETL desde la BD transaccional hacia la gerencial';

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
        $etl = new Etl;
        $query = 'select * from departments';
        $optionsE = ['connection' => 'mysql',];
        // $options = ['connection' => 'STDB', ];
        $optionsT = ['type'=> 'both',];
        // $options = ['connection' => 'default',];
        $optionsL = ['connection' => 'STDB'];

        $etl->extract('query', $query, $optionsE)
            ->transform('trim', $optionsT)
            ->load('insert_update','departments', $optionsL)
            ->run();

    }
}
