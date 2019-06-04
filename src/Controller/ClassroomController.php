<?php

namespace App\Controller;

use App\Service\ClassroomService;
use Doctrine\ORM\ORMInvalidArgumentException;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Psr\Log\LoggerInterface;
Use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClassroomController extends FOSRestController
{

    private $service;

    private $logger;

    public function __construct(ClassroomService $classroomService, LoggerInterface $logger)
    {
        $this->service = $classroomService;
        $this->logger = $logger;
    }

    /**
     * @Rest\Get("/classrooms", name="classrooms")
     */
    public function index(): JsonResponse
    {
        try {
            return $this->json([
                'classrooms' => $this->service->getAllClassrooms(),
            ]);
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage());
            throw new \Exception('Something went wrong!');
        }
    }

    /**
     * @Rest\Get("/classroom/{id}")
     */
    public function classroom(int $id): JsonResponse
    {
        try {
            return $this->json([
                'classroom' => $this->service->getOneById($id),
            ]);
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage());
            throw new \Exception('Something went wrong!');
        }
    }

    /**
     * @Rest\Post("/classroom")
     */
    public function create(Request $request): JsonResponse
    {
        try {
            return $this->json([
                'classroom' => $this->service->createClassroom($request),
            ]);
        } catch (ORMInvalidArgumentException $e) {
            throw new \Exception('Classroom is not saved.');
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage());
            throw new \Exception('Something went wrong!');
        }
    }

    /**
     * @Rest\Put("/classroom/{id}")
     */
    public function update(Request $request, int $id): JsonResponse
    {
        try {
            return $this->json([
                'classroom' => $this->service->updateClassroom($request, $id),
            ]);
        } catch (ORMInvalidArgumentException $e) {
            throw new \Exception('Classroom is not updated.');
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage());
            throw new \Exception('Something went wrong!');
        }
    }

    /**
     * @Rest\Delete("/classroom/{id}")
     */
    public function delete(int $id): JsonResponse
    {
        try {
            return $this->json([
                'message' => 'Classroom deleted',
            ]);
        } catch (NotFoundHttpException $e) {
            return $this->json([
                'message' => $e->getMessage(),
            ]);
        } catch (ORMInvalidArgumentException $e) {
            throw new \Exception('Classroom is not deleted.');
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage());
            throw new \Exception('Something went wrong!');
        }
    }
}
