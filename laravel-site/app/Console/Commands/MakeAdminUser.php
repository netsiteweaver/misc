<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MakeAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-admin-user
        {--name= : Full name}
        {--email= : Email address (required)}
        {--password= : Password (optional; if omitted, a random one is generated)}
        {--force : Do not ask for confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or promote a user to admin (for Filament back office)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = (string) ($this->option('email') ?? '');
        if ($email === '') {
            $this->error('Missing required option: --email');
            return self::FAILURE;
        }

        $name = (string) ($this->option('name') ?? '');
        if ($name === '') {
            $name = 'Admin';
        }

        $password = (string) ($this->option('password') ?? '');
        $generated = false;
        if ($password === '') {
            $password = Str::password(16);
            $generated = true;
        }

        if (! $this->option('force')) {
            $ok = $this->confirm("Create / promote admin user for {$email}?", true);
            if (! $ok) {
                $this->info('Aborted.');
                return self::SUCCESS;
            }
        }

        $user = User::query()->where('email', $email)->first();
        if (! $user) {
            $user = User::query()->create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'is_admin' => true,
            ]);
        } else {
            $user->forceFill([
                'name' => $user->name ?: $name,
                'is_admin' => true,
            ])->save();

            if ($this->option('password')) {
                $user->forceFill(['password' => Hash::make($password)])->save();
            }
        }

        $this->info("Admin user ready: {$user->email}");
        if ($generated) {
            $this->warn("Generated password: {$password}");
            $this->warn('Save it somewhere safe. You can change it later.');
        }

        $this->line('Login at: /admin');
        return self::SUCCESS;
    }
}
