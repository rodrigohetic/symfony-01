<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CategoryFixtures extends AppFixtures implements DependentFixtureInterface
{
    protected function loadData(): void
    {
        $this->createMany(3, 'category', function () {
            $categoriesNormals = ['blonde', 'brune', 'blanche'];
            return (new Category())
                ->setName($this->faker->randomElement($categoriesNormals))
                ->setDescription($this->faker->paragraph(3, true));
        });

        $this->createMany(8, 'category_specials', function () {
            $categoriesSpecials = ['houblon', 'rose', 'menthe', 'grenadine', 'réglisse', 'marron', 'whisky', 'bio'];
            return (new Category())
                ->setName($this->faker->randomElement($categoriesSpecials))
                ->setDescription($this->faker->paragraph(3, true));
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
        ];
    }
}

