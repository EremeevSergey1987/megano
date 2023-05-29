<?php

namespace App\Controller\Admin;

use App\Entity\Category;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/admin/category/create', name: 'app_admin_category_create')]
    public function create(EntityManagerInterface $em)
    {
        $category = new Category();
        $category
            ->setName('Категория ' . rand(100, 999))
            ->setSlug('categoria-' . rand(100, 999))
            ->setText('Большой текст');
            if(rand(1,10) > 4){
                $category->setPublishedAt(new \DateTimeImmutable(sprintf('-%d days', rand(0, 50))));
            }

        $em->persist($category);
        $em->flush();

        return new Response(sprintf(
            'Создана статья ID - %d slug - %s',
            $category->getId(),
            $category->getSlug()
        ));
    }
}
