<?php

namespace App\DataFixtures;


use App\Entity\Statistic;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class StatisticFixtures extends AppFixtures implements DependentFixtureInterface
{
    protected function loadData(): void
    {
        $this->createMany(4, 'statistic', function () {
            $beer = $this->getRandomReference('beer');
            $client = $this->getRandomReference('client');

            return (new Statistic())
                ->addBeerId($beer)
                ->addCliendId($client)
                ->setScore($this->faker->randomElement([1, 2, 3, 4, 5]));
        });
    }

    public function getDependencies()
    {
        return array(
            ClientFixtures::class,
            BeerFixtures::class,
        );
    }
}
