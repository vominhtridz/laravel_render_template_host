<?php

namespace Database\Seeders;

use App\Models\permissions;
use App\Models\roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $admin =roles::create(['name' => 'admin']);  
       $viewer =roles::create(['name' => 'viewer']);  
       $editor =roles::create(['name' => 'editor']);
    $permissions = [
        'create',
        'update',
        'delete',
        'view',
    ];
        foreach ($permissions as $permission) {
            $perm = permissions::create(['name' => $permission]);
            $admin->permissions()->attach($perm); // Admin has all permissions
        }

        // Editor can create and edit posts
        $editor->permissions()->attach(permissions::whereIn('name', ['create', 'update','view'])->get());

        // Viewer can only view posts
        $viewer->permissions()->attach(permissions::where('name', 'view')->first());
        
    }
}
