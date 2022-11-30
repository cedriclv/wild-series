<?php

namespace App\DataFixtures;

use App\Entity\Program;
use App\DataFixtures\CategoryFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i<15;$i++){
            $program = new Program();
            $program->setTitle('program number ' . $i);
            $program->setSynopsis('Synopsis text ' . $i);
            $program->setPoster('poster number ' . $i);
            $program->setTitle('program number ' . $i);
            $randomCatId = random_int(0,4);
            $program->setCategory($this->getReference('category_' . CategoryFixtures::CATEGORIES[$randomCatId]));
            $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
