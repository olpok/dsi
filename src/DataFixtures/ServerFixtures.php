<?php

namespace App\DataFixtures;

use App\Entity\Server;
use App\Entity\Version;
use App\Entity\Software;
use App\Repository\SoftwareRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ServerFixtures extends Fixture
{
    /**
     * @var SoftwareRepository
     */
    private $repository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->repository = $em->getRepository(Software::class);

    }

    public function load(ObjectManager $manager)
    {
        for ($i=1; $i < 8; $i++) { 
            
            $server = new Server();
            $software = new Software();
          //  $this->softwares = $repository->findAll();

                $server->setName("Nom de serveur N°$i");
                $software->setName("logiciel test $i");

                $server->addSoftware($software); 


            $manager->persist($server);
            $manager->persist($software);

                 for ($k=1; $k <= mt_rand(4,7); $k++) { 
                    
                        $version = new Version();
                            $version->setNumber($k);
                            $version->setSoftware($software);

                        $manager->persist($version);
              
                    }
            
        }

        
        $manager->flush();
    }
}
