<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use DB;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["guard_name" => "web", "name" => "log-viewers.read"],
            ["guard_name" => "web", "name" => "control panel.read"],
            ["guard_name" => "web", "name" => "setting.read"],
            ["guard_name" => "web", "name" => "setting/manage_account.read"],
            ["guard_name" => "web", "name" => "setting/manage_account/users.create"],
            ["guard_name" => "web", "name" => "setting/manage_account/users.read"],
            ["guard_name" => "web", "name" => "setting/manage_account/users.update"],
            ["guard_name" => "web", "name" => "setting/manage_account/users.delete"],
            ["guard_name" => "web", "name" => "setting/manage_account/users.reset-password"],
            ["guard_name" => "web", "name" => "setting/manage_account/roles.create"],
            ["guard_name" => "web", "name" => "setting/manage_account/roles.read"],
            ["guard_name" => "web", "name" => "setting/manage_account/roles.update"],
            ["guard_name" => "web", "name" => "setting/manage_account/roles.delete"],
            ["guard_name" => "web", "name" => "setting/manage_account/permissions.read"],
            ["guard_name" => "web", "name" => "setting/manage_data.read"],
            ["guard_name" => "web", "name" => "setting/manage_data/study_program.create"],
            ["guard_name" => "web", "name" => "setting/manage_data/study_program.read"],
            ["guard_name" => "web", "name" => "setting/manage_data/study_program.update"],
            ["guard_name" => "web", "name" => "setting/manage_data/study_program.delete"],
            ["guard_name" => "web", "name" => "setting/manage_data/department.create"],
            ["guard_name" => "web", "name" => "setting/manage_data/department.read"],
            ["guard_name" => "web", "name" => "setting/manage_data/department.update"],
            ["guard_name" => "web", "name" => "setting/manage_data/department.delete"],
            ["guard_name" => "web", "name" => "manage_announcement.read"],
            ["guard_name" => "web", "name" => "manage_announcement.create"],
            ["guard_name" => "web", "name" => "manage_announcement.delete"],
            ["guard_name" => "web", "name" => "manage_announcement.update"],
            ["guard_name" => "web", "name" => "manage_admin"],
            ["guard_name" => "web", "name" => "manage_warek1"],
            ["guard_name" => "web", "name" => "manage_warek2"],
            ["guard_name" => "web", "name" => "manage_reviewer"],
            ["guard_name" => "web", "name" => "manage_headoflppm"],

            //tambahkan permissionnya disini
        ];

        foreach ($data as $x) {
            if (!Permission::where('name', $x['name'])
                ->where('guard_name', $x['guard_name'])->first()) {
                $permission = Permission::create(['name' => $x['name'], 'guard_name' => $x['guard_name']]);

                // Assign permissions to the admin role
                $role_admin = Role::where('name', "admin")->first();
                $role_admin->givePermissionTo($x['name']);

                // Assign specific permissions to other roles
                if ($x['name'] == "manage_reviewer") {
                    $role_reviewer = Role::where('name', "reviewer")->first();
                    $role_reviewer->givePermissionTo($x['name']);
                }
                if ($x['name'] == "manage_warek1") {
                    $role_warek1 = Role::where('name', "warek1")->first();
                    $role_warek1->givePermissionTo($x['name']);
                }
                if ($x['name'] == "manage_warek2") {
                    $role_warek2 = Role::where('name', "warek2")->first();
                    $role_warek2->givePermissionTo($x['name']);
                }
            }

        }
    }

}
