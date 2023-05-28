<?php

namespace App\Controller;
use App\Entity\Products;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class catalogController extends AbstractController
{
    public $items = [
        [
            'category' => 'Category name',
            'img' => '/assets/img/content/home/card.jpg',
            'desc' => 'Corsair Carbide Series Arctic White Steel 1',
            'price' => '85.00',
            'price_sale' => '75.00',
        ],
        [
            'category' => 'Category name',
            'img' => '/assets/img/content/home/card.jpg',
            'desc' => 'Corsair Carbide Series Arctic White Steel 2',
            'price' => '85.00',
            'price_sale' => '75.00',
        ],
        [
            'category' => 'Category name',
            'img' => '/assets/img/content/home/card.jpg',
            'desc' => 'Corsair Carbide Series Arctic White Steel 3',
            'price' => '85.00',
            'price_sale' => '75.00',
        ],
        [
            'category' => 'Category name',
            'img' => '/assets/img/content/home/card.jpg',
            'desc' => 'Corsair Carbide Series Arctic White Steel 4',
            'price' => '85.00',
            'price_sale' => '75.00',
        ],
    ];
    /**
     * @Route("/catalog/{slug}")
     */
    public function show(Request $request, $slug = false, EntityManagerInterface $entity)
    {
        $repository = $entity->getRepository(Products::class);
        $product = $repository->findOneBy(['slug' => $slug]);

        if(! $product){
            throw $this->createNotFoundException(sprintf('Статья %s не найдена'), $slug);
        }
        //dd($product);

        $query = $request->query->get('query');
        //dd($query);

        return $this->render('catalog/show.html.twig', [
            'article' => $product,
            'items' => $this->items,
        ]);
    }
}