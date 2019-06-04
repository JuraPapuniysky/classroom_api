<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Classroom;
use App\Factories\ClassroomFactory;
use App\Repository\ClassroomRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ClassroomService
{
    /**
     * @var ClassroomRepository
     */
    private $repository;

    /**
     * @var ClassroomFactory
     */
    private $factory;

    public function __construct(ClassroomRepository $classroomRepository, ClassroomFactory $classroomFactory)
    {
        $this->repository = $classroomRepository;
        $this->factory = $classroomFactory;
    }

    public function getOneById(int $id): ?Classroom
    {
        return $this->repository->find($id);
    }

    public function getOneByName(string $name): ?Classroom
    {
        return $this->repository->findOneBy(['name' => $name]);
    }

    public function getAllClassrooms(): array
    {
        return $this->repository->findAll();
    }

    public function createClassroom(Request $request): ?Classroom
    {
        $classroom = $this->factory->createClassroom($request);
        $classroom = $this->repository->save($classroom);

        return $classroom;
    }

    public function updateClassroom(Request $request, int $id): ?Classroom
    {
        if (($classroom = $this->repository->find($id)) === null) {
            throw new NotFoundHttpException('Classroom not found.');
        }
        $classroom = $this->factory->updateClassroom($request, $classroom);
        $classroom = $this->repository->save($classroom);

        return $classroom;
    }

    public function activeClassroom(int $id): Classroom
    {
        if (($classroom = $this->repository->find($id)) === null) {
            throw new NotFoundHttpException('Classroom not found.');
        }

        if (!$classroom->getIsActive()) {
            $classroom->setIsActive(true);
            $classroom = $this->repository->save($classroom);
        }

        return $classroom;
    }

    public function passiveClassroom(int $id): Classroom
    {
        if (($classroom = $this->repository->find($id)) === null) {
            throw new NotFoundHttpException('Classroom not found.');
        }

        if ($classroom->getIsActive()) {
            $classroom->setIsActive(false);
            $classroom = $this->repository->save($classroom);
        }

        return $classroom;
    }

    public function deleteClassroom(int $id): void
    {
        if (($classroom = $this->repository->find($id)) !== null) {
            $this->repository->delete($classroom);
        } else {
            throw new NotFoundHttpException('Classroom not found.');
        }
    }
}