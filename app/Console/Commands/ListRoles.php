<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class ListRoles extends Command
{
    protected $signature = 'roles:list';
    protected $description = 'Lista todos los roles disponibles';

    public function handle()
    {
        $roles = Role::all();

        if ($roles->isEmpty()) {
            $this->info('No hay roles definidos.');
            return;
        }

        $this->info('Roles disponibles:');
        foreach ($roles as $role) {
            $this->line('- ' . $role->name);
        }
    }
}
