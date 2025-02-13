<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AssignAdminRole extends Command
{
    protected $signature = 'user:make-admin {email}';
    protected $description = 'Attribuer le rôle d\'administrateur à un utilisateur';

    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error('Utilisateur non trouvé.');
            return;
        }

        $user->role = 'admin'; // Assurez-vous que le champ "role" existe dans votre table "users"
        $user->save();

        $this->info("L'utilisateur {$email} est maintenant un administrateur.");
    }
}
