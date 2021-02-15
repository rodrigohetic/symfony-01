<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CategoryFixtures extends AppFixtures implements DependentFixtureInterface
{
    protected function loadData(): void
    {
        $categoriesNormals = ['blonde', 'brune', 'blanche'];
        $categoriesSpecials = ['houblon', 'rose', 'menthe', 'grenadine', 'réglisse', 'marron', 'whisky', 'bio'];

        $this->createMany(10, 'category', function () {
            return (new Category())
                ->setName($this->faker->$categoriesNormals));
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

