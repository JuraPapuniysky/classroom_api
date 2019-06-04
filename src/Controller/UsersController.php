<?php
namespace App\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;

class UsersController extends FOSRestController
{
    /**
     * @Rest\Get("/users", name="users")
     */
    public function getAction()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path'    => 'src/Controller/UsersController.php',
        ]);
    }
}
