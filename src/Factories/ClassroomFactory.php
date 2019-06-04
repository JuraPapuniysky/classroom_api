<?php

declare(strict_types=1);

namespace App\Factories;

use App\Entity\Classroom;
use App\Models\ClassroomResponseModel;
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
        $classroom->setName($request->get('name'));
        if ((integer)$request->get('isActive') === 1) {
            $classroom->setIsActive(true);
        } else {
            $classroom->setIsActive(false);
        }

        return $classroom;
    }
}