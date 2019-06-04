<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Classroom;
use App\Repository\ClassroomRepository;

class ClassroomService
{
    private $repository;

    public function __construct(ClassroomRepository $classroomRepository)
    {
        $this->repository = $classroomRepository;
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

    public function createClassroom(): bool
    {

    }

    public function updateClassroom(): bool
    {

    }

    public function deleteClassroom(int $id): bool
    {
        $classroom = $this->repository->find($id);

        return $this->repository->delete($classroom);
    }
}