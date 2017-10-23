<?php

use Illuminate\Database\Seeder;
use App\Models\Kitten;

class KittensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $k = 0;
        while ($k < 100) {
            factory(Kitten::class, 10000)->create();
            ++$k;
        }
    }
}

