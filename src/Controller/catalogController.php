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
    /**
     * @Route("/category/{slug}")
     */
    public function show(Request $request, $slug, EntityManagerInterface $em, CategoryRepository $repository)
    {
        $category = $em->getRepository(Category::class)->findOneBy(['slug' => $slug]);

        if( ! $category){
            throw $this->createNotFoundException(sprintf('Категория %s не найдена'), $slug);
        }

        //$items = $repository->findBy(['category' => $category]);

        $items = $category->getProducts();

        foreach ($items as $item){
            dump($item);
        }



        $query = $request->query->get('query');
        return $this->render('/category/show.html.twig', [
            'category' => $category,
            'categorys' => $this->getCategory($repository),
        ]);
    }
}