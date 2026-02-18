<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ListUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = \App\User::all();
        foreach ($users as $user) {
            $this->info("Email: " . $user->email . " | Role: " . $user->role);
        }

        return 0;
    }
}
