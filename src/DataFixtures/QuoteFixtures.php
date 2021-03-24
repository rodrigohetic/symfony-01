<?php
namespace App\DataFixtures;

use App\Entity\Quote;

class QuoteFixtures extends AppFixtures
{
    protected function loadData(): void
    {
        $this->faker->addProvider(new \DavidBadura\FakerMarkdownGenerator\FakerProvider($this->faker));

        $this->createMany(10, 'quotes', function ($i) {
        $positions = ['none', 'important'];

            return (new Quote())
                ->setTitle($this->faker->catchPhrase)
                ->setContent($this->faker->markdown)
                ->setPosition($this->faker->randomElement($positions))
                ->setCreatedAt($this->faker->dateTimeBetween());
        });
    }

}