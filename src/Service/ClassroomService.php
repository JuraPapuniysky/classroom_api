<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Classroom;
use App\Factories\ClassroomFactory;
use App\Repository\ClassroomRepository;
use Symfony\Component\HttpFoundation\Request;

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
        if ($this->repository->save($classroom)) {
            return $classroom;
        }

        return null;
    }

    public function updateClassroom(Request $request, int $id): ?Classroom
    {
        $classroom = $this->repository->find($id);
        $classroom = $this->factory->updateClassroom($request, $classroom);
        if ($this->repository->save($classroom)) {
            return $classroom;
        }

        return null;
    }

    public function deleteClassroom(int $id): void
    {
        $classroom = $this->repository->find($id);
        $this->repository->delete($classroom);
    }
}