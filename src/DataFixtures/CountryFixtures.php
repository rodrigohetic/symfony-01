<?php

namespace App\DataFixtures;

use App\Entity\Country;

class CountryFixtures extends AppFixtures
{
    protected function loadData(): void
    {
        $this->createMany(15, 'country', function () {
            return (new Country())
                ->setName($this->faker->country())
                ->setAddress($this->faker->address())
                ->setEmail($this->faker->email())
                ;
        });
    }
}