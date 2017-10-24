<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Kitten;
use Carbon\Carbon;

/**
 * Class SearchKittensTest
 * Given a random kitten I should be able to find the same kitten by filtering its properties
 * @package Tests\Feature
 */
class SearchKittensTest extends TestCase
{

    public function testFindByAge()
    {

        $kitten = Kitten::inRandomOrder()->first();

        $kittenAge = $kitten->dob->diffInYears(Carbon::now());

        $filters = "?filters[age]=$kittenAge&filters[id]={$kitten->id}";
        $response = $this->get('/kittens' . $filters);

        $data = json_decode($response->getContent(), true);
        $foundKitten = reset($data['data']);

        $response->assertStatus(200);
        $this->assertTrue($kitten->id === $foundKitten['id']);
    }

    private function searchAttribute($attribute)
    {

        $kitten = Kitten::inRandomOrder()->first();

        $filters = "?filters[$attribute]={$kitten->$attribute}&filters[id]={$kitten->id}";
        $response = $this->get('/kittens' . $filters);

        $data = json_decode($response->getContent(), true);
        $foundKitten = reset($data['data']);

        $response->assertStatus(200);
        $this->assertTrue($kitten->id === $foundKitten['id']);

    }

    public function testSearchAttributes()
    {
        $this->searchAttribute('gender');
        $this->searchAttribute('color');
        $this->searchAttribute('firstName');
        $this->searchAttribute('lastName');

    }


}