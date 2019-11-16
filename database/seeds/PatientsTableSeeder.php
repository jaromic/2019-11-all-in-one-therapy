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
        for ($i = 0; $i <= 50; ++$i) {
            $firstname = Arr::random(['Fritz', 'Franz', 'Karl', 'Josef', 'Agnes', 'Birgit', 'Sabine', 'Dorothea', 'Bianca', 'Alice', 'Sara', 'Fred', 'Otto', 'Sebastian', 'Michael', 'Alexander', 'Andreas', 'Silvia', 'Sibel', 'Amon', 'Birte', 'Ingrid', 'Klara', 'Larissa', 'Olivia']);
            $lastname = Arr::random(['Mueller', 'Maier', 'Brunner', 'Berger', 'Wolf', 'Putz', 'Schmied', 'Hofer', 'Wallner', 'Kurz', 'Lang', 'Zeit', 'Gans', 'Maus', 'Schatten', 'Gebauer', 'Konrad', 'Meyer', 'Meier', 'Mayer', 'Stein', 'Hafner', 'Herter', 'Bald', 'Sagmeister', 'Uhrmann', 'Becker', 'Toll', 'Loeffler', 'Lasser', 'Geber', 'Gerber', 'Hart', 'Blatt', 'Rosenberg', 'Baston', 'Pavlovsky', 'Ilicali', 'Wojcek', 'Baer', 'Denk', 'Haflinger', 'Sauber', 'Tann', 'Schaerdinger', 'Goestli', 'Zweig', 'Debbels', 'Horch', 'Mann', 'Huebsch', 'Dicke', 'Fern', 'Kalb', 'Wolf', 'Laut', 'Abzal']);
            $svnr = rand(1000, 9999) . sprintf("%02s%02s%02s", rand(1, 28), rand(1, 12), rand(1, 99));
            $this->insertPatient($firstname, $lastname, $svnr);
        }
        $this->insertPatient('David', 'Doerfler', 1234010183);
    }

    /**
     * @param $firstname
     * @param $lastname
     * @param string $svnr
     */
    private function insertPatient(string $firstname, string $lastname, string $svnr): void
    {
        DB::table('patients')->insert([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'svnr' => $svnr,
            'plz' => rand(100, 999) . "0",
            'city' => Arr::random(['Wien', 'St. Pölten', 'Eisenstadt', 'Graz', 'Innsbruck', 'Klagenfurt', 'Bregenz', 'Salzburg', 'Linz']),
            'country' => 'Österreich',
            'address' => strtoupper(Str::random(1)) . strtolower(Str::random(4)) . "gasse 1/1",
            'email' => strtolower($firstname) . "." . strtolower($lastname) . '@example.com',
        ]);
    }
}
