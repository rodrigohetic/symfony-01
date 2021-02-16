<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\BeerRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{id}", name="category")
     */
    public function index(CategoryRepository $repoCat, BeerRepository $repoBeer, $id): Response
    {
        $category = $repoCat->find($id);
        $beers = $repoBeer->findBeerByCategoryId($id);

        return $this->render('category/index.html.twig', [
            'title' => '',
            'category' => $category,
            'beers' => $beers
        ]);
    }
}
