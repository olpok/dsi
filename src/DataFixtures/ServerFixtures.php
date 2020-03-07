<?php

namespace App\DataFixtures;

use App\Entity\Server;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ServerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i < 6; $i++) { 
            
            $server = new Server();
                $server->setName("Nom de serveur N°$i");
            $manager->persist($server);
        }
        
        $manager->flush();
    }
}
