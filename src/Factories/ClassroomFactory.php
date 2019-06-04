<?php

declare(strict_types=1);

namespace App\Factories;

use App\Entity\Classroom;
use Symfony\Component\HttpFoundation\Request;

class ClassroomFactory
{
    public function createClassroom(Request $request): Classroom
    {
        $classroom = new Classroom();
        $classroom = $this->setClassroomFromRequest($request, $classroom);

        return $classroom;
    }

    public function updateClassroom(Request $request, Classroom $classroom): Classroom
    {
        $classroom = $this->setClassroomFromRequest($request, $classroom);

        return $classroom;
    }

    private function setClassroomFromRequest(Request $request, Classroom $classroom): Classroom
    {
        $requestData = json_decode($request->getContent(), true);
        $classroom->setName($requestData['name']);
        if ($requestData['isActive'] === true) {
            $classroom->setIsActive(true);
        } else {
            $classroom->setIsActive(false);
        }

        return $classroom;
    }
}