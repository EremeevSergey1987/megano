<?php

namespace App\Controller;
use App\Entity\Products;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class catalogController extends pagesController
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
     * @Route("/category/{slug}")
     */
    public function show(Request $request, $slug, EntityManagerInterface $em, CategoryRepository $repository)
    {
        $category = $em->getRepository(Category::class)->findOneBy(['slug' => $slug]);

        if( ! $category){
            throw $this->createNotFoundException(sprintf('Категория %s не найдена'), $slug);
        }

        $query = $request->query->get('query');
        //dump($this->getCategory($repository));


        return $this->render('/category/show.html.twig', [
            'category' => $category,
            'items' => $this->items,
            'categorys' => $this->getCategory($repository),
        ]);
    }
}