<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class createUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new VPN Panel Account.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $username = $this->ask('Username ');
        $email = $this->ask('Email Address ');
        $password = $this->secret('Password (You can\'t see what you typed in.)');

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            return $this->info('[ERROR] Please enter a valid email!');
        }

        User::create([
            'name' => $username,
            'email' => $email,
            'password' => bcrypt($password)
        ]);

        return $this->info('User created successfully!');

    }
}
