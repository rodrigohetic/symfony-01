<?php

namespace App\Controller;

use App\Entity\Beer;
use App\Entity\Category;
use App\Repository\BeerRepository;
use App\Repository\CategoryRepository;
use App\Repository\ClientRepository;
use App\Repository\CountryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BarController extends AbstractController
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @Route("/", name="home")
     */
    public function bar(BeerRepository $repoBeers): Response
    {
        $lastBeers = $repoBeers->findLastBeers();

        return $this->render('bar/index.html.twig', [
            'controller_name' => 'HomeController',
            'title' => 'Les dernières bières ajoutées',
            'lastBeers' => $lastBeers
        ]);
    }

    /**
     * @Route("/mentions", name="mentions")
     */
    public function mentions(): Response
    {
        return $this->render('mention/index.html.twig', [
            'controller_name' => 'MentionController',
            'title' => 'Mentions Légales',
        ]);
    }

    /**
     * @Route("/beer/{id}", name="beer_page")
     * @param Beer $beer
     * @return Response
     */
    public function beer(Beer $beer, CategoryRepository $repoCat, CountryRepository $repoCountry): Response
    {
        $beerCatSpecial = $repoCat->findCatSpecial($beer->getId());
        $beerCatNormal = $repoCat->findByTerm('normal');
        $beerCountry = $repoCountry->findCountryByBeerId($beer->getId());

        return $this->render('beer/index.html.twig', [
            'controller_name' => 'BeerController',
            'title' => "Beer Page - ".$beer->getName(),
            'beer' => $beer,
            'beerCatSpecial' =>  $beerCatSpecial,
            'beerCatNormal' =>  $beerCatNormal,
            'beerCountry' => $beerCountry

        ]);
    }

    /**
     * @Route("/menu", name="menu")
     */
    public function mainMenu(string $category_id, string $routeName): Response{
        $repoCat= $this->getDoctrine()->getRepository(Category::class);
        $categories = $repoCat ->findByTerm('normal');

        return $this->render('_partials/menu.html.twig', [
            'categories' => $categories,
            'category_id' => $category_id,
            'routeName' => $routeName
        ]);
    }

    /**
     * @Route("/statistic", name="statistic")
     */
    public function statistic(ClientRepository $clientRepo): Response{
        $clients = $clientRepo->findAll();
        $avgBeerBought= $clientRepo->getAvgNumberBeer();

        return $this->render('statistic/index.html.twig', [
            'controller_name' => 'StatisticController',
            'title' => "Statistic",
            'clients' => $clients,
            'avgBeersBought' => implode($avgBeerBought[0])
        ]);
    }

}
