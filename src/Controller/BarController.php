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
     * @Route("/bar", name="bar")
     */
    public function bar(): Response
    {

        return $this->render('bar/index.html.twig', [
            'controller_name' => 'BarController',
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

    private function beers_api(): array
    {
        $response = $this->client->request(
            'GET',
            'https://raw.githubusercontent.com/Antoine07/hetic_symfony/main/Introduction/Data/beers.json'
        );

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content;
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
    public function beer(Beer $beer, int $id): Response
    {
        //$reponse = $this->beers_api();
        dump($beer);

        return $this->render('beer/index.html.twig', [
            'controller_name' => 'BeerController',
            'title' => 'Beers',
            'beers' => $beer
        ]);
    }

    /**
     * @Route("/newbeer", name="create_beer")
     */
    public function createBeer(){
        $entityManager = $this->getDoctrine()->getManager();

        $beer = new Beer();
        $beer->setname('Super Beer');
        $beer->setPublishedAt(new \DateTime());
        $beer->setDescription('Ergonomic and stylish!');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($beer);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new beer with id '.$beer->getId());
    }

    /**
     * @Route("/newcategory", name="create_category")
     */
    public function createCategory(){
        // new category
        $category = new Category();
        $category->setName('Houblon');
        $category->setDescription('Houblon');

        // new beer
        $beer = new Beer();
        $beer->setName('Beer new');
        $beer->setDescription('Ergonomic and stylish!');

        // relates this beer to the category
        $category->addBeer($beer);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($category);
        $entityManager->persist($beer);
        $entityManager->flush();

        return new Response(
            'Saved new beer with id: ' . $beer->getId()
            . ' and new category with id: ' . $category->getId()
        );
    }

}
