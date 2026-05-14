<?php

namespace App\DataFixtures;

use App\Entity\Circuit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Prestation;
class CircuitFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $circuitSahara = new Circuit();
        $circuitSahara->setTitreCircuit('Découverte du Sahara');
        $circuitSahara->setDescriptionLongue('Un circuit complet pour découvrir les paysages du Sahara.');
        $circuitSahara->setItineraire('Alger → Ghardaïa → Timimoun → Alger');
        $circuitSahara->setDuree('5 jours');
        $circuitSahara->setStatut('actif');
       $circuitSahara->setPrestation($this->getReference(PrestationFixtures::PRESTATION_SAHARA, Prestation::class));
        $manager->persist($circuitSahara);

        $circuitAlger = new Circuit();
        $circuitAlger->setTitreCircuit('Alger culturel');
        $circuitAlger->setDescriptionLongue('Visite culturelle de la capitale et de ses monuments.');
        $circuitAlger->setItineraire('Casbah → Jardin d’Essai → Maqam Echahid');
        $circuitAlger->setDuree('2 jours');
        $circuitAlger->setStatut('actif');
        $circuitAlger->setPrestation($this->getReference(PrestationFixtures::PRESTATION_ALGER, Prestation::class));


        $manager->persist($circuitAlger);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            PrestationFixtures::class,
        ];
    }
}