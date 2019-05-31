<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

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

        //Permisos comunes
        $p1 = Permission::create([
            'name'          =>  'Editar datos de la cuenta',
            'slug'          =>  'cuenta.edit',
            'description'   =>  'Permite editar los datos de una cuenta particular',
        ]);
        $r1->permissions()->save($p1);
        $r2->permissions()->save($p1);
        $r3->permissions()->save($p1);

        // Permisos correspondientes al administrador
        $p2 = Permission::create([
            'name'          =>  'Navegar usuarios',
            'slug'          =>  'users.index',
            'description'   =>  'Lista y navega todos los usuarios del sistema',
        ]);
        $p3 = Permission::create([
            'name'          =>  'Detalle usuarios',
            'slug'          =>  'users.show',
            'description'   =>  'Muestra el detalle de un usuario del sistema',
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

        // Permisos comunes del usuario de negocio táctico y estratégico
        $p6 = Permission::create([
            'name'          =>  'Generar reportes',
            'slug'          =>  'report.generate',
            'description'   =>  'Generar algun tipo de reporte',
        ]);
        $r2->permissions()->save($p6);
        $r3->permissions()->save($p6);

        //Permisos del usuario de negocio estrategico
        $p7 = Permission::create([
            'name'          =>  'Mantenimientos superiores a 40%',
            'slug'          =>  'report.manteniSuperiores40',
            'description'   =>  'Permite generar el reporte donde aparecen los mantenimientos con costos superiores al 40%',
        ]);
        $p8 = Permission::create([
            'name'          =>  'Mantenimientos por departamento',
            'slug'          =>  'report.cantidadManteniDepartamento',
            'description'   =>  'Permite ver la cantidad de mantenimientos por departamento',
        ]);
        $p9 = Permission::create([
            'name'          =>  'Equipo agregado',
            'slug'          =>  'report.equipoInfoAgregadoInventario',
            'description'   =>  'Permite ver el equipo informático agregado al inventario',
        ]);
        $p10 = Permission::create([
            'name'          =>  'Repuestos cambiados',
            'slug'          =>  'report.repuestosCambiados',
            'description'   =>  'Permite ver los repuestos que han sido cambiados en equipo informático',
        ]);
        $p11 = Permission::create([
            'name'          =>  'Usuarios más demandantes',
            'slug'          =>  'report.usuariosMasSolicitantes',
            'description'   =>  'Permite ver los usuarios que más solicitan mantenimiento',
        ]);
        $r2->permissions()->saveMany([$p7, $p8, $p9, $p10, $p11]);

        //Permisos del usuario de negocio tactico
        $p12 = Permission::create([
            'name'          =>  'Garantías a vencer',
            'slug'          =>  'report.garantiasAVencer',
            'description'   =>  'Permite ver las garantías proximas a vencer o vencidas',
        ]);
        $p13 = Permission::create([
            'name'          =>  'Mantenimientos solicitados',
            'slug'          =>  'report.manteniSolicitados',
            'description'   =>  'Permite ver los mantenimientos que han sido solicitados',
        ]);
        $p14 = Permission::create([
            'name'          =>  'Mantenimientos realizados',
            'slug'          =>  'report.manteniRealizados',
            'description'   =>  'Mantenimientos realizados por el encargado de soporte',
        ]);
        $p15 = Permission::create([
            'name'          =>  'Licencias próximas a vencer o vencidas',
            'slug'          =>  'report.licencias',
            'description'   =>  'Permite ver las licencias de software vencidas o por vencer',
        ]);
        $p16 = Permission::create([
            'name'          =>  'Equipo descargado',
            'slug'          =>  'report.equipoDescargado',
            'description'   =>  'Permite ver los equipos que han sido descargados',
        ]);
        $p17 = Permission::create([
            'name'          =>  'Equipo antiguo',
            'slug'          =>  'report.equipoAntiguo',
            'description'   =>  'Permite ver los equipos se consideran viejos',
        ]);
        $r3->permissions()->saveMany([$p12, $p13, $p14, $p15, $p16, $p17]);

    }
}
