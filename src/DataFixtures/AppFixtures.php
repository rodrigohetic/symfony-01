<?php

namespace App\DataFixtures;

use Faker\Factory;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use Faker\Generator;

abstract class AppFixtures extends Fixture
{
    private $manager;
    /** @var Generator */
    protected $faker;
    /**
     * Listes de références vers des entités
     * @var string[][] un tableau contenant des tableaux de chaînes de caractères
     */
    private $references = [];

    /**
     * Méthode à implémenter pour charger les entités
     * Une méthode abstraite ne possède pas de corps et doit obligatoirement être implémentée
     * par les classes qui héritent de BaseFixture
     */
    abstract protected function loadData(): void;

    /**
     * Méthode initialement appelée par le système de fixtures
     * On enregistre nos propriétés et on appelle loadData()
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->faker = Factory::create('fr_FR');

        // Les entités seront générées dans loadData() qui aura donc appelé $manager->persist()
        $this->loadData();
        $this->manager->flush();
    }

    /**
     * Créer un certain nombre d'entités
     * @param int $count        Nombre d'entités à générer
     * @param string $groupName Le nom à donner en référence pour toutes les entités générées
     * @param callable $factory La fonction qui doit générer 1 entité
     */
    protected function createMany(int $count, string $groupName, callable $factory): void
    {
        for ($i = 0; $i < $count; $i++) {
            // On doit exécuter la fonction $factory qui doit retourner l'entité générée
            $entity = $factory($i);

            if ($entity === null) {
                throw new \LogicException('L\'entité doit être retournée !');
            }

            // On prépare à l'enregistrement de l'entité
            $this->manager->persist($entity);

            // On enregistre une référence pour l'entité récupérée
            // Afin de pouvoir la récupérer plus tard, dans d'autres classes de Fixtures
            $reference = sprintf('%s_%d', $groupName, $i);
            $this->addReference($reference, $entity);
        }
    }

    /**
     * Récupérer 1 entité de manière aléatoire
     * @param string $groupName le nom commun aux références dans lesquelles rechercher
     * @return object une entité du groupe demandé
     */
    protected function getRandomReference(string $groupName): object
    {
        // Si le groupe demandé est inconnu, on recherche les références
        if (!isset($this->references[$groupName])) {
            $this->references[$groupName] = [];

            // On parcourt l'ensemble des références
            foreach ($this->referenceRepository->getReferences() as $refName => $val) {
                // $refName = référence d'un objet (exemple: artist_42)
                // On vérifie si $refName commence par $groupName
                // (sa position dans $refName doit être à 0)
                if (strpos($refName, $groupName.'_') === 0) {
                    $this->references[$groupName][] = $refName;
                }
            }
        }

        // On vérifie que l'on ait trouvé des références
        if ($this->references[$groupName] === []) {
            throw new \Exception(sprintf('Aucun référence trouvée pour le groupe "%s"', $groupName));
        }

        // Récupération aléatoire d'un objet associé à une référence du groupe
        $randomRefName = $this->faker->randomElement($this->references[$groupName]);
        return $this->getReference($randomRefName);
    }
}