<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class pagesController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {
        return $this->render('pages/homepage.html.twig', [

        ]);
    }

    /**
     * @Route("/{slug}", name="app_page")
     */
    public function pages($slug){
        if($slug == 'contacts') {
            return $this->render('pages/contacts.html.twig', [

            ]);
        }

        if($slug == 'about') {
            return $this->render('pages/about.html.twig', [

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
                'items' => $items,
            ]);
        }
    }


}