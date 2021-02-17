<?php

namespace App\DataFixtures;


use App\Entity\Client;

class ClientFixtures extends AppFixtures
{
    protected function loadData(): void
    {
        $this->createMany(15, 'client', function () {
            return (new Client())
                ->setEmail($this->faker->email())
                ->setAge($this->faker->numberBetween(18,99))
                ->setWeight($this->faker->randomFloat(0,0,50))
                ->setName($this->faker->firstName())
                ->setNumberBeer($this->faker->numberBetween(6,99));
        });
    }
}