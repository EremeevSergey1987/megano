<?php

namespace App\Controller;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class pagesController extends AbstractController
{
    public function getCategory(CategoryRepository $repository)
    {
        $categorys = $repository->findLatestPublished();
        return $categorys;
    }
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(CategoryRepository $repository)
    {
        return $this->render('pages/homepage.html.twig', [
            'categorys' => $this->getCategory($repository),
        ]);
    }

    /**
     * @Route("/{slug}", name="app_page")
     */
    public function pages($slug, CategoryRepository $repository){
        if($slug == 'contacts') {
            return $this->render('pages/contacts.html.twig', [
                'category' => ['name' => 'Контакты'],
                'categorys' => $this->getCategory($repository),
            ]);
        }

        if($slug == 'about') {
            return $this->render('pages/about.html.twig', [
                'category' => ['name' => 'О нас'],
                'categorys' => $this->getCategory($repository),

            ]);
        }
        if($slug == 'compare') {
            return $this->render('pages/compare.html.twig', [
                'category' => ['name' => 'СРАВНЕНИЕ ТОВАРОВ'],
                'categorys' => $this->getCategory($repository),
            ]);
        }
        if($slug == 'login') {
            return $this->render('pages/login.html.twig', [
                'category' => ['name' => 'Авторизация'],
                'categorys' => $this->getCategory($repository),
            ]);
        }
        if($slug == 'register') {
            return $this->render('pages/register.html.twig', [
                'category' => ['name' => 'Авторизация'],
                'categorys' => $this->getCategory($repository),
            ]);
        }





        if($slug == 'catalog') {
            $items = [
                [
                    'category' => 'Category name',
                    'img' => 'assets/img/content/home/card.jpg',
                    'desc' => 'Corsair Carbide Series Arctic White Steel 1',
                    'price' => '85.00',
                    'price_sale' => '75.00',
                ],
                [
                    'category' => 'Category name',
                    'img' => 'assets/img/content/home/card.jpg',
                    'desc' => 'Corsair Carbide Series Arctic White Steel 2',
                    'price' => '85.00',
                    'price_sale' => '75.00',
                ],
                [
                    'category' => 'Category name',
                    'img' => 'assets/img/content/home/card.jpg',
                    'desc' => 'Corsair Carbide Series Arctic White Steel 3',
                    'price' => '85.00',
                    'price_sale' => '75.00',
                ],
                [
                    'category' => 'Category name',
                    'img' => 'assets/img/content/home/card.jpg',
                    'desc' => 'Corsair Carbide Series Arctic White Steel 4',
                    'price' => '85.00',
                    'price_sale' => '75.00',
                ],
            ];
            return $this->render('catalog/catalog.html.twig', [
                'category' => ['name' => 'Каталог'],
                'items' => $items,
                'categorys' => $this->getCategory($repository),
            ]);
        }
    }


}