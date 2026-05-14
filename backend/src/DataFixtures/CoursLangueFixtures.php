<?php

namespace App\DataFixtures;

use App\Entity\CoursLangue;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Prestation;

class CoursLangueFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $coursAnglais = new CoursLangue();
        $coursAnglais->setLangue('Anglais');
        $coursAnglais->setNiveau('Débutant');
        $coursAnglais->setDescriptifProgramme('Programme de base pour apprendre les fondamentaux de l’anglais.');
        $coursAnglais->setPrestation($this->getReference(PrestationFixtures::PRESTATION_ANGLAIS, Prestation::class));

        $coursAnglais->setStatut('actif');
        $manager->persist($coursAnglais);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            PrestationFixtures::class,
        ];
    }
}