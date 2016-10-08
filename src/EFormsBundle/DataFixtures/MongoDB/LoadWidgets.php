<?php

namespace EFormsBundle\DataFixtures\MongoDB;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EFormsBundle\Document\Widget;

class LoadWidgets implements FixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $widget = new Widget();


        $manager->persist($widget);
        $manager->flush();
    }
}