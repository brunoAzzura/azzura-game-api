<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\GoodToKnow;

class LoadUserData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setName('bruno');
        $user->setEmail('bruno.co@azzura.com');
        $manager->persist($user);
        $manager->flush();

        $goodToKnow = new GoodToKnow();
        $goodToKnow->setType('img');
        $goodToKnow->setPath('info1.png');
        $manager->persist($goodToKnow);
        $manager->flush();

        $goodToKnow = new GoodToKnow();
        $goodToKnow->setType('img');
        $goodToKnow->setPath('info1.png');
        $manager->persist($goodToKnow);
        $manager->flush();

        $goodToKnow = new GoodToKnow();
        $goodToKnow->setType('img');
        $goodToKnow->setPath('info1.png');
        $manager->persist($goodToKnow);
        $manager->flush();

        $goodToKnow = new GoodToKnow();
        $goodToKnow->setType('img');
        $goodToKnow->setPath('info1.png');
        $manager->persist($goodToKnow);
        $manager->flush();

        $goodToKnow = new GoodToKnow();
        $goodToKnow->setType('img');
        $goodToKnow->setPath('info1.mp4');
        $manager->persist($goodToKnow);
        $manager->flush();

        // $user->addGoodToKnow($goodToKnow);
        // $manager->persist($user);
        // $manager->flush();


    }
}