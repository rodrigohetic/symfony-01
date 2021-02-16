<?php

namespace App\Controller;

use App\Entity\Beer;
use App\Entity\Category;
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
    public function bar(): Response
    {

        return $this->render('bar/index.html.twig', [
            'controller_name' => 'HomeController',
            'title' => 'The Bar',
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
     * @Route("/beers", name="beers")
     */
    public function beers(): Response
    {
        //$reponse = $this->beers_api();
        $repoBeer = $this->getDoctrine()->getRepository(Beer::class);
        $reponse = $repoBeer->findByExampleField();

        return $this->render('beers/index.html.twig', [
            'controller_name' => 'MentionController',
            'title' => 'Beers',
            'beers' => $reponse
        ]);
    }

    /**
     * @Route("/beer/{id}", name="beer_page")
     * @param Beer $beer
     * @return Response
     */
    public function beer(Beer $beer): Response
    {
        return $this->render('beer/index.html.twig', [
            'controller_name' => 'BeerController',
            'title' => "Beer Page -".$beer->getName(),
            'beer' => $beer
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


}
