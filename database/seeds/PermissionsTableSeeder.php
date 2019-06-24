<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;
use App\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // DB::transaction(function() {
            //Creación de roles
            $r1 = Role::create([
                'name'  =>  'Administrador',
                'slug'  =>  'admin',
            ]);
            $r2 = Role::create([
                'name'  =>  'Estrategico',
                'slug'  =>  'estrategico',
            ]);
            $r3 = Role::create([
                'name'  =>  'Tactico',
                'slug'  =>  'tactico',
            ]);

            // Permisos correspondientes al administrador
            $p3 = Permission::create([
                'name'          =>  'Gestion de Usuarios',
                'slug'          =>  'gesti.users',
                'description'   =>  'Acceso a las opciones de gestionar usuarios',
            ]);
            $p2 = Permission::create([
                'name'          =>  'Navegar usuarios',
                'slug'          =>  'users.index',
                'description'   =>  'Lista y navega todos los usuarios del sistema',
            ]);
            $p4 = Permission::create([
                'name'          =>  'Crear usuarios',
                'slug'          =>  'users.create',
                'description'   =>  'Crea usuarios del sistema',
            ]);
            $p5 = Permission::create([
                'name'          =>  'Editar usuarios',
                'slug'          =>  'users.edit',
                'description'   =>  'Edita un usuario del sistema',
            ]);
            $r1->permissions()->saveMany([$p2, $p3, $p4, $p5]);
            $r2->permissions()->saveMany([$p2, $p3, $p4, $p5]);

            // Permisos comunes del usuario de negocio táctico y estratégico
            $p20 = Permission::create([
                'name'          =>  'Puede reportar',
                'slug'          =>  'report.report',
                'description'   =>  'Puede generar reportes',
            ]);

            $p6 = Permission::create([
                'name'          =>  'Generar reportes gerenciales',
                'slug'          =>  'report.generateGerenciales',
                'description'   =>  'Generar algun tipo de reporte gerencial',
            ]);

            $p1 = Permission::create([
                'name'          =>  'Generar reportes tacticos',
                'slug'          =>  'report.generateTactico',
                'description'   =>  'Generar algun tipo de reporte tactico',
            ]);
            
            $r2->permissions()->save($p6);
            $r2->permissions()->save($p1);
            $r3->permissions()->save($p1);

            $r2->permissions()->save($p20);
            $r3->permissions()->save($p20);

            //Permisos del usuario de negocio estrategico
            $p7 = Permission::create([
                'name'          =>  'Mantenimientos realizados',
                'slug'          =>  'report.mantenimientosRealizados',
                'description'   =>  'Permite ver los mantenimientos realizados por encargados',
            ]);
            $p8 = Permission::create([
                'name'          =>  'Repuestos cambiados',
                'slug'          =>  'report.repuestosCambiados',
                'description'   =>  'Permite ver los repuestos cambiados en mantenimientos',
            ]);
            $p9 = Permission::create([
                'name'          =>  'Clientes y mantenimientos',
                'slug'          =>  'report.clientesYMantenimientos',
                'description'   =>  'Permite ver los clientes que demandan más mantenimientos',
            ]);
            $p10 = Permission::create([
                'name'          =>  'Mantenimiento mayor a 40% de costo de adqui',
                'slug'          =>  'report.mayor40Adqui',
                'description'   =>  'Permite ver los mantenimientos que superan el 40% del costo de adquisición',
            ]);
            $p11 = Permission::create([
                'name'          =>  'Cantidad de mantenimientos por depto',
                'slug'          =>  'report.cantidadManteniDepto',
                'description'   =>  'Permite ver los mantenimientos solicitados por departamento',
            ]);
            $r2->permissions()->saveMany([$p7, $p8, $p9, $p10, $p11]);

            //Permisos del usuario de negocio tactico
            $p12 = Permission::create([
                'name'          =>  'Equipo agregado',
                'slug'          =>  'report.equipoAgregado',
                'description'   =>  'Permite ver el equipo agregado a inventario',
            ]);
            $p13 =  Permission::create([
                'name'          =>  'Licencias próximas a vencer o vencidas',
                'slug'          =>  'report.licencias',
                'description'   =>  'Permite ver las licencias de software vencidas o por vencer',
            ]);
            $p14 = Permission::create([
                'name'          =>  'Equipo descargado',
                'slug'          =>  'report.equipoDescargado',
                'description'   =>  'Permite ver los equipos que han sido descargados',
            ]);
            $p15 = Permission::create([
                'name'          =>  'Equipo antiguo',
                'slug'          =>  'report.equipoAntiguo',
                'description'   =>  'Permite ver los equipos se consideran viejos',
            ]);
            $p16 = Permission::create([
                'name'          =>  'Cantidad de Manteni solicitados',
                'slug'          =>  'report.cantidadManteniSolicitados',
                'description'   =>  'Permite ver la cantidad de mantenimientos solicitados',
            ]);
            $p17 = Permission::create([
                'name'          =>  'Equipo con garantías vencidas',
                'slug'          =>  'report.garantiasVencidas',
                'description'   =>  'Permite ver las garantías vencidas o por vencer',
            ]);
            $r3->permissions()->saveMany([$p12, $p13, $p14, $p15, $p16, $p17]);
            $r2->permissions()->saveMany([$p12, $p13, $p14, $p15, $p16, $p17]);

            //Permisos extras del administrador
            $p18 = Permission::create([
                'name'          =>  'Ver bitacoras de la aplicación',
                'slug'          =>  'bitacora',
                'description'   =>  'Permite ver la bitacora de la aplicación'
            ]);
            $p19 = Permission::create([
                'name'          =>  'Ejecutar ETL',
                'slug'          =>  'etl',
                'description'   =>  'Permite ejecutar el ETL para cargar el SIG'
            ]);
            $r1->permissions()->saveMany([$p18, $p19]);

            //Asignando rol a los usuarios iniciales
            User::find(1)->roles()->save($r1);
            User::find(2)->roles()->save($r2);
            User::find(3)->roles()->save($r3);
       // });
        
    }
}
