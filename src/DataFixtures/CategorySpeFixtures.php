<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CategorySpeFixtures extends AppFixtures implements DependentFixtureInterface
{
    protected function loadData(): void
    {
        $this->createMany(8, 'category_specials', function ($i) {
            $categoriesSpecials = ['houblon', 'rose', 'menthe', 'grenadine', 'réglisse', 'marron', 'whisky', 'bio'];
            return (new Category())
                ->setName($categoriesSpecials[$i])
                ->setDescription($this->faker->paragraph(3, true))
                ->setTerm('specials');
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

