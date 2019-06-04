<?php

namespace App\Controller;

use App\Service\ClassroomService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;

class ClassroomController extends FOSRestController
{

    private $service;

    public function __construct(ClassroomService $classroomService)
    {
        $this->service = $classroomService;
    }

    /**
     * @Rest\Get("/classrooms", name="classrooms")
     */
    public function index()
    {
        return $this->json([
            'classrooms' => $this->service->getAllClassrooms(),
        ]);
    }
}
