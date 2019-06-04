<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Classroom;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $names = ['first', 'second'];

        foreach($names as $name) {
            $classroom = new Classroom();
            $classroom->setName($name);
            $classroom->setIsActive(true);

            $manager->persist($classroom);
        }

        $manager->flush();
    }
}
