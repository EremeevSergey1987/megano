<?php

namespace App\Controller\Admin;

use App\Entity\Products;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    #[Route('/admin/products/create', name: 'app_admin_products_create')]
    public function create(EntityManagerInterface $entity)
    {

        $products = new Products();
        $products
            ->setName('Corsair Carbide Series Arctic White Steel 1')
            ->setSlug('Corsair-Carbide-Series-Arctic-White-Steel-' . rand(100, 999))
            ->setDescription('Desc text')
            ->setImg('');
            //->setCategory();

        if(rand(1, 10) > 4){
            $products->setPublishedAt(new \DateTimeImmutable(sprintf('-%d days', rand(0, 50))));

        }

        $entity->persist($products);
        $entity->flush();


        return new Response(sprintf(
            'Создана статья id: %d, slug: $s',
            $products->getId(),
            $products->getSlug(),
        ));
    }
}
