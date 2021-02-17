<?php

namespace App\DataFixtures;

use App\Entity\Country;

class CountryFixtures extends AppFixtures
{
    protected function loadData(): void
    {

        $this->createMany(4, 'country', function ($i) {
            $countries = ['Belgium', 'France', 'England', 'Germany'];

            return (new Country())
                ->setName($countries[$i])
                ->setAddress($this->faker->address())
                ->setName($this->faker->email());
        });
    }
}
