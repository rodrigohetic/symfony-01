<?php

namespace App\DataFixtures;

use App\Entity\Beer;
use App\Entity\Country;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BeerFixtures extends AppFixtures implements DependentFixtureInterface
{
    protected function loadData(): void
    {
        $this->createMany(50, 'beer', function () {
            $country = $this->getRandomReference('country');
            $category = $this->getRandomReference('category');
            $category_specials = $this->getRandomReference('category_specials');

            return (new Beer())
                ->setName($this->faker->lastName . ' Beer')
                ->setCountry($country)
                ->setDescription($this->faker->paragraph(1, true))
                ->setDegree($this->faker->randomFloat(2, 3, 100))
                ->setPrice($this->faker->randomFloat(2,2,10))
                ->setPublishedAt($this->faker->dateTimeBetween('-6 month'))
                ->addCategory($category)
                ->addCategory($category_specials);
        });
    }

    /**
     * Méthode à implémenter pour DependentFixtureInterface
     * On retourne un tableau avec le nom des classes de fixtures
     * qui doivent être chargées avant RecordFixtures
     */
    public function getDependencies()
    {
        return [
            CountryFixtures::class,
            CategoryFixtures::class,
            CategorySpeFixtures::class
        ];
    }

    // public function setCategoryAccordingToTerm()
    // {
    //     $categoriesNormals = ['blonde', 'brune', 'blanche'];
    //     $categoriesSpecials = ['houblon', 'rose', 'menthe', 'grenadine', 'réglisse', 'marron', 'whisky', 'bio'];

    //     if ($this->term === "normal") {
    //         return $this->faker->randomElement($categoriesNormals);
    //     } else {
    //         return $this->faker->randomElement($categoriesSpecials);
    //     }
    // }
}
