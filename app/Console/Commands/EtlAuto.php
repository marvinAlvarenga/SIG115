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

    //estos nombres corresponden a la fuente y destino de datos. Deben existir en config/database.php
    const source = 'mysql';
    const dest = 'STDB';

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
      $etl2 = new Etl;
      $etl3 = new Etl;
      $etl4 = new Etl;
      $etl5 = new Etl;
      $etl6 = new Etl;
      $etl7 = new Etl;
      $etl8 = new Etl;
      $etl9 = new Etl;
      $etl10 = new Etl;

      $etl->extract('query', 'select * from departments', ['connection' => self::source,])
            ->transform('trim', ['type'=> 'both',])
            ->load('insert_update','departments', ['connection' => self::dest])
            ->run();

      $etl2->extract('query', 'select * from employees', ['connection' => self::source,])
            ->transform('trim', ['type'=> 'both',])
            ->load('insert_update','employees', ['connection' => self::dest])
            ->run();

      $etl3->extract('query', 'select * from products', ['connection' => self::source,])
            ->transform('trim', ['type'=> 'both',])
            ->load('insert_update','products', ['connection' => self::dest])
            ->run();

      $etl4->extract('query', 'select * from spares', ['connection' => self::source,])
          ->transform('trim', ['type'=> 'both',])
          ->load('insert_update','spares', ['connection' => self::dest])
          ->run();

      $optionsUpkps = [
        'connection' => self::dest,
        'columns' => ['id', 'product_id', 'user_id', 'tipoequipo']
      ];

      $etl5->extract('query', 'select * from upkeeps', ['connection' => self::source,])
          ->transform('trim', ['type'=> 'both',])
          ->load('insert_update','upkeeps', $optionsUpkps)
          ->run();

      $optionsUpksSprL = [
        'connection' => self::dest,
        'key'=> ['spare_id', 'upkeep_id'],
        'columns'=> ['spare_id', 'upkeep_id'],
        ];

      $etl6->extract('query', 'select * from upkeep_spare', ['connection' => self::source,]);
          $etl6->transform('trim', ['type'=> 'both',]);
          $etl6 ->load('insert_update','upkeep_spare', $optionsUpksSprL);
          $etl6->run();
    //
      $etl7->extract('query', 'select * from licences', ['connection' => self::source,])
          ->transform('trim', ['type'=> 'both',])
          ->load('insert_update','licences', ['connection' => self::dest])
          ->run();

      $optionsProdLicsL = [
        'connection' => self::dest,
        'key'=> ['licence_id', 'product_id'],
      ];

      $etl8->extract('query', 'select * from product_licence', ['connection' => self::source,])
          ->transform('trim', ['type'=> 'both',])
          ->load('insert_update','product_licence', $optionsProdLicsL)
          ->run();

      $OptsReleaseL = [
        'connection' => self::dest,
        'columns' => ['id', 'codigo', 'cantidad', 'created_at', 'updated_at'],
        'timestamps'=> false
      ];

      $etl9->extract('query', 'select * from releases', ['connection' => self::source,])
          ->transform('trim', ['type'=> 'both',])
          ->load('insert_update','releases', $OptsReleaseL)
          ->run();

      $optionsProdRelsL = [
          'connection' => self::dest,
          'key'=> ['release_id', 'product_id'],
        ];

      $etl10->extract('query', 'select * from product_release', ['connection' => self::source,])
          ->transform('trim', ['type'=> 'both',])
          ->load('insert_update','product_release', $optionsProdRelsL)
          ->run();


    }
}
