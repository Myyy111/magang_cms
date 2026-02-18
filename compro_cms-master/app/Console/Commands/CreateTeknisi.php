<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateTeknisi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create-teknisi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or update user with teknisi role';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = \App\User::where('email', 'teknisi@mail.com')->first();
        if (!$user) {
            $user = new \App\User();
            $user->name = 'Teknisi 1';
            $user->email = 'teknisi@mail.com';
            $user->password = \Illuminate\Support\Facades\Hash::make('password');
            $user->role = 'teknisi';
            $user->save();
            $this->info("User teknisi@mail.com created successfully.");
        } else {
            $user->role = 'teknisi';
            $user->save();
            $this->info("User teknisi@mail.com updated to teknisi role.");
        }

        return 0;
    }
}
