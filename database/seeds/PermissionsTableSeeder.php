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
      // Admin
        Permission::Create([
          "name" => "Navegar ordenes",
          "slug" => "orders.index",
          "description" => "Lista y navega en todas las ordenes generadas por los clientes"
        ]);

       // Permisos para los roles
       Permission::Create([
         "name" => "Navegar roles",
         "slug" => "roles.index",
         "description" => "Lista y navega en todos los roles"
       ]);
       Permission::Create([
         "name" => "Ver Rol",
         "slug" => "roles.show",
         "description" => "Visualizar a detalle un rol"
       ]);
       Permission::Create([
         "name" => "Crear un rol",
         "slug" => "roles.create",
         "description" => "Creacion de roles"
       ]);
       Permission::Create([
         "name" => "Edicion rol",
         "slug" => "roles.edit",
         "description" => "Edita todos los roles"
       ]);
       Permission::Create([
         "name" => "Elimina rol",
         "slug" => "roles.destroy",
         "description" => "Eliminar cualquier rol"
       ]);
       Permission::Create([
         "name" => "Dashboard",
         "slug" => "dashboard",
         "description" => "Panel Administrador"
       ]);
    }
}
