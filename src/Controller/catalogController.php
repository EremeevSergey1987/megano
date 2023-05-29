<?php

namespace App\Controller;
use App\Entity\Products;
use App\Entity\Category;
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
     * @Route("/category/{slug}")
     */
    public function show(Request $request, $slug, EntityManagerInterface $em)
    {

        $repository = $em->getRepository(Category::class);
        $category = $repository->findOneBy(['slug' => $slug]);

        if( ! $category){
            throw $this->createNotFoundException(sprintf('Категория %s не найдена'), $slug);
        }
        //dd($category);

        $query = $request->query->get('query');
        //dd($query);

        return $this->render('/category/show.html.twig', [
            'category' => $category,
            'items' => $this->items,
        ]);
    }
}