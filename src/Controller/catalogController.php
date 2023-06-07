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
        return $this->render('/category/show.html.twig', [
            'category' => $category,
            'categorys' => $this->getCategory($repository),
        ]);
    }
}