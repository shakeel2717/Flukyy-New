<?php

namespace App\Console\Commands;

use App\Models\admin;
use App\Models\advertisement;
use App\Models\contest;
use App\Models\Customer;
use App\Models\Supplier;
use App\Models\users;
use App\Models\Warehouse;
use Illuminate\Console\Command;

class createUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Default user for Testing Product';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        users::create([
            'fname' => 'Shakeel',
            'lname' => 'Ahmad',
            'username' => 'shakeel2717',
            'email' => 'shakeel2717@gmail.com',
            'password' => 'asdfasdf',
            'status' => 'Active',
        ]);


        users::create([
            'fname' => 'Basharat',
            'lname' => 'Ali',
            'username' => 'basharat604',
            'email' => 'basharat604@gmail.com',
            'password' => 'asdfasdf',
            'status' => 'Active',
        ]);


        contest::create([
            'contest' => "XFXS5DF4S6D5F4S",
            'price' => 1,
            'status' => "Active",
            'participate' => 2,
        ]);


        admin::create([
            'username' => 'test',
            'password' => 'test',
            'contest' => 50,
            'withdraw' => 10,
        ]);


        advertisement::create([
            'title' => 'Google',
            'url' => 'https://www.google.com/',
            'price' => 1,
        ]);

        advertisement::create([
            'title' => 'Ask',
            'url' => 'https://www.ask.com/',
            'price' => 1,
        ]);


        advertisement::create([
            'title' => 'Yahoo',
            'url' => 'https://www.yahoo.com/',
            'price' => 1,
        ]);

        
        return $this->info('Test Account Setup Successfully');
    }
}
