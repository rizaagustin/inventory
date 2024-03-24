<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            ['name' => 'role-index'], ['name' => 'role-create'], ['name' => 'role-delete'], ['name' => 'role-update'],
            ['name' => 'permission-index'], ['name' => 'permission-create'], ['name' => 'permission-delete'], ['name' => 'permission-update'],
            ['name' => 'user-index'], ['name' => 'user-create'], ['name' => 'user-delete'], ['name' => 'user-update'],            
            ['name' => 'customer-index'], ['name' => 'customer-create'], ['name' => 'customer-delete'], ['name' => 'customer-update'],
            ['name' => 'supplier-index'],['name' => 'supplier-create'],  ['name' => 'supplier-delete'], ['name' => 'supplier-update'],            
            ['name' => 'product-index'], ['name' => 'product-create'], ['name' => 'product-delete'], ['name' => 'product-update'],
            ['name' => 'productin-index'], ['name' => 'productin-create'], ['name' => 'productin-delete'], ['name' => 'productin-update'],
            ['name' => 'productout-index'], ['name' => 'productout-create'], ['name' => 'productout-delete'], ['name' => 'productout-update'],
            ['name' => 'report-index'],['name' => 'dashboard-index']
        ])->each(fn ($data) => Permission::create($data));
    }
}
