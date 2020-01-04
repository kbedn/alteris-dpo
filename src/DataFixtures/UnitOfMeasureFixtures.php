<?php

namespace App\DataFixtures;

use App\Entity\UnitOfMeasure;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;

class UnitOfMeasureFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 4; $i++) {
            $unitOfMeasure = new UnitOfMeasure();
            $unitOfMeasure
                ->setName('UnitOfMeasure_' . $i)
                ->setShortcut('short_' . $i)
                ->setMaterials(new ArrayCollection())
            ;

            $manager->persist($unitOfMeasure);
            $this->addReference(self::class . $i, $unitOfMeasure);
        }

        $manager->flush();
    }
}
