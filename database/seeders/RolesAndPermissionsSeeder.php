<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        
        $ownerRole = Role::create(["name"=>"owner"]);
        $adminRole = Role::create(["name"=>"admin"]);
        $memberRole = Role::create(["name"=>"member"]);
        $guestRole = Role::create(["name"=>"guest"]);


        // Permissions for the stated roles 
        $viewPublicSpacesPermissions = Permission::create(["name"=>"view public spaces"]);
        $accessPublicSpacesPermissions = Permission::create(["name"=>"access public spaces"]);
        $manageSpacesPermissions = Permission::create(["name"=>"manage spaces"]);
        $managePeoplePermissions = Permission::create(["name"=>"manage people"]);
        $manageWorkSpacePermissions = Permission::create(["name"=>"manage workspace settings"]);
        $deleteWorkSpacePermissions = Permission::create(["name"=>"delete workspace"]);

        $ownerRole->syncPermissions([$viewPublicSpacesPermissions,$accessPublicSpacesPermissions, $manageSpacesPermissions, $managePeoplePermissions, $manageWorkSpacePermissions, $deleteWorkSpacePermissions]);
        $adminRole->syncPermissions([$accessPublicSpacesPermissions, $viewPublicSpacesPermissions, $managePeoplePermissions,$manageWorkSpacePermissions, $deleteWorkSpacePermissions]);
        $memberRole->givePermissionTo([$accessPublicSpacesPermissions, $viewPublicSpacesPermissions]);
        $guestRole->givePermissionTo([$viewPublicSpacesPermissions]);

    }
}
