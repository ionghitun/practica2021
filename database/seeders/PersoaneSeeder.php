<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;//Il apelam pe user

use Illuminate\Support\Facades\Hash;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class PersoaneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         
    //    factory(App\User::class, 30)->create(); 
       \App\Models\User::factory()->count(2)->create();

        
    }
}
