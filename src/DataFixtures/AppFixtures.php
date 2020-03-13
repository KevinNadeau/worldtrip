<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Voyage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $admin = new Admin();
        $admin->setUsername('Eric')
                ->setPassword('tripfamille');
        $encoded = $this->encoder->encodePassword($admin, $admin->getPassword());
        $admin->setPassword($encoded);

        $manager->persist($admin);

        for($i = 0; $i < 12; $i++){
            $voyage = new Voyage();
            $voyage->setTitre('Notre voyage')
                    ->setDescription('Lolilala Lolilala Lolilala v LolilalaLolilala Lolilala Lolilala')
                    ->setImage('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTphB5gN43dvEps0kPiTVv8W3qmsednLkJGJIDeQgP1Xt5MF6w&s')
            ;
            $manager->persist($voyage);
        }

        $manager->flush();
    }
}
