<?php

use App\Documentation;
use App\Patient;
use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleNames = [
            'patient',
            'assistant',
            'therapist',
            'admin',
        ];

        foreach ($roleNames as $roleName) {
            $role = new Role();
            $role->name = $roleName;
            $role->save();
        }

        $loginPermission = Permission::where('name','login')->first();
        $patientPermission = Permission::where('name','patient')->first();
        $calendarPermission = Permission::where('name','calendar')->first();
        $documentationPermission = Permission::where('name','documentation')->first();

        $patientRole=Role::where('name', 'patient')->first();
        $assistantRole=Role::where('name', 'assistant')->first();
        $therapistRole=Role::where('name', 'therapist')->first();
        $adminRole=Role::where('name', 'admin')->first();

        $patientRole->permissions()->attach($loginPermission->id);

        $assistantRole->permissions()->attach($loginPermission->id);
        $assistantRole->permissions()->attach($patientPermission->id);
        $assistantRole->permissions()->attach($calendarPermission->id);

        $therapistRole->permissions()->attach($loginPermission->id);
        $therapistRole->permissions()->attach($patientPermission->id);
        $therapistRole->permissions()->attach($calendarPermission->id);
        $therapistRole->permissions()->attach($documentationPermission->id);

        $adminRole->permissions()->attach($loginPermission->id);
        $adminRole->permissions()->attach($patientPermission->id);
        $adminRole->permissions()->attach($calendarPermission->id);
        $adminRole->permissions()->attach($documentationPermission->id);
    }
}
