<?php

namespace App\DataFixtures;

use App\Entity\Country;

class CountryFixtures extends AppFixtures
{
    protected function loadData(): void
    {

        $this->createMany(15, 'country', function () {
            $countries = ['Belgium', 'France', 'England', 'Germany'];

            return (new Country())
                ->setName($this->faker->randomElement($countries));
        });
    }
}
