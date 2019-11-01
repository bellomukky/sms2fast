<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            'reseller_id'=>0,
            'last_name'=>'Muktar',
            'first_name'=>'Bello',
            'email'=>'user@email.com',
            'phone_number'=>'08136327341',
            'password'=>'$2y$10$BdvDT0AuCcGlK0e77HQ2O.nX57LbIARGkpYwXX.jMC6oH5BQzY/8q'
        ]);
    }
}
