<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\Controller\Annotations\View;

class DefaultController extends AbstractController
{
    use ControllerTrait;

    /**
     * @Route("/", name="default_index")
     * @view()
     */
    public function index(){
        return new JsonResponse([
            'action' => 'index',
            'time' => time()
        ]);
    }
}