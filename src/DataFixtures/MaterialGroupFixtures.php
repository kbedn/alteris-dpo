<?php

namespace App\DataFixtures;

use App\Entity\MaterialGroup;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MaterialGroupFixtures extends Fixture
{
    public const NODE_WITH_NO_CHILDREN = 'node_with_no_children';

    public function load(ObjectManager $manager)
    {
        $group = new MaterialGroup();
        $group->setName('grupa');

        $manager->persist($group);

        for ($i = 0; $i < 3; $i++) {
            $child = new MaterialGroup();
            $child
                ->setName('grupa_' . $i)
                ->setParent($group)
            ;

            $manager->persist($child);
        }
        $this->addReference(self::NODE_WITH_NO_CHILDREN, $child);
        $manager->flush();
    }
}
