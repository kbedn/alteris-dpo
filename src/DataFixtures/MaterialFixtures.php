<?php

namespace App\DataFixtures;

use App\Entity\Material;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MaterialFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 4; $i++) {
            $material = new Material();
            $material
                ->setName('materiał_' . $i)
                ->setCode(uniqid('', true))
                ->setUnitOfMeasure($this->getReference(UnitOfMeasureFixtures::class . $i))
                ->setGroup($this->getReference(MaterialGroupFixtures::NODE_WITH_NO_CHILDREN))
            ;
            $manager->persist($material);
        }
        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [
            UnitOfMeasureFixtures::class,
            MaterialGroupFixtures::class,
        ];
    }
}
