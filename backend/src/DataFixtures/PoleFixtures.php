<?php

namespace App\DataFixtures;

use App\Entity\Pole;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PoleFixtures extends Fixture
{
    public const POLE_TOURISME    = 'pole-tourisme';
    public const POLE_IT          = 'pole-it';
    public const POLE_EVENT       = 'pole-event';
    public const POLE_COURS       = 'pole-cours';

    public function load(ObjectManager $manager): void
    {
        $poles = [
            self::POLE_TOURISME => [
                'nom'         => 'Tourisme',
                'description' => 'Pôle dédié aux voyages, circuits et prestations touristiques.',
            ],
            self::POLE_IT => [
                'nom'         => 'IT',
                'description' => 'Pôle dédié au développement informatique.',
            ],
            self::POLE_EVENT => [
                'nom'         => 'Event',
                'description' => 'Pôle dédié à l\'organisation des événements.',
            ],
            self::POLE_COURS => [
                'nom'         => 'Cours de langues',
                'description' => 'Pôle dédié aux formations et cours de langues.',
            ],
        ];

        foreach ($poles as $reference => $data) {
            $pole = new Pole();
            $pole->setNomPole($data['nom']);
            $pole->setDescription($data['description']);
            $pole->setDateCreation(new \DateTimeImmutable());
            $manager->persist($pole);
            $this->addReference($reference, $pole);
        }

        $manager->flush();
    }
}