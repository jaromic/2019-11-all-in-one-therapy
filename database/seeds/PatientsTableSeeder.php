<?php

use Illuminate\Database\Seeder;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 100; ++$i) {
            $firstname=Arr::random(['Fritz', 'Franz', 'Karl', 'Josef', 'Agnes', 'Birgit', 'Sabine', 'Dorothea']);
            $lastname=Arr::random(['Mueller', 'Maier', 'Brunner', 'Berger', 'Wolf', 'Putz', 'Schmied', 'Hofer',]);
            DB::table('patients')->insert([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'svnr' => rand(1000, 9999) . sprintf("%02s%02s%02s", rand(1, 28), rand(1, 12), rand(1, 99)),
                'plz' => rand(100, 999)."0",
                'city' => Arr::random(['Wien','St. Pölten','Eisenstadt','Graz','Innsbruck','Klagenfurt','Bregenz','Salzburg','Linz']),
                'country' => 'Österreich',
                'address' => strtoupper(Str::random(1)) . strtolower(Str::random(4)) . "gasse 1/1",
                'email' => strtolower($firstname) . "." . strtolower($lastname) . '@example.com',
            ]);
        }
    }
}
