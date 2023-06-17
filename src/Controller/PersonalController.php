<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


class PersonalController extends pagesController
{
    #[Route('/personal', name: 'app_personal')]

    public function index(CategoryRepository $repository): Response
    {

        $this->denyAccessUnlessGranted('ROLE_USER');

        return $this->render('personal/index.html.twig', [
            'category' => 'Секретный кабинет',
            'categories' => parent::getCategory($repository)
        ]);
    }
}
