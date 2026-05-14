<?php

namespace App\DataFixtures;

use App\Entity\Prestation;
use App\Entity\Pole;
use App\Entity\Photo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PrestationFixtures extends Fixture implements DependentFixtureInterface
{
    public const PRESTATION_SAHARA  = 'prestation-sahara';
    public const PRESTATION_ALGER   = 'prestation-alger';
    public const PRESTATION_ANGLAIS = 'prestation-anglais';

    public function load(ObjectManager $manager): void
    {
        $prestationSahara = new Prestation();
        $prestationSahara->setTitreService('Circuit Sahara');
        $prestationSahara->setDescription('Prestation touristique pour découvrir le Sahara.');
        $prestationSahara->setStatut('actif');
        $prestationSahara->setDateCreation(new \DateTimeImmutable());
        $prestationSahara->setPole($this->getReference(PoleFixtures::POLE_TOURISME, Pole::class));
        $prestationSahara->setPhoto($this->getReference('photo-sahara', Photo::class));
        $manager->persist($prestationSahara);
        $this->addReference(self::PRESTATION_SAHARA, $prestationSahara);

        $prestationAlger = new Prestation();
        $prestationAlger->setTitreService('Circuit Alger culturel');
        $prestationAlger->setDescription('Prestation touristique pour visiter Alger.');
        $prestationAlger->setStatut('actif');
        $prestationAlger->setDateCreation(new \DateTimeImmutable());
        $prestationAlger->setPole($this->getReference(PoleFixtures::POLE_TOURISME, Pole::class));
        $prestationAlger->setPhoto($this->getReference('photo-alger', Photo::class));
        $manager->persist($prestationAlger);
        $this->addReference(self::PRESTATION_ALGER, $prestationAlger);

        $prestationAnglais = new Prestation();
        $prestationAnglais->setTitreService('Cours d\'anglais débutant');
        $prestationAnglais->setDescription('Formation destinée aux débutants en anglais.');
        $prestationAnglais->setStatut('actif');
        $prestationAnglais->setDateCreation(new \DateTimeImmutable());
        $prestationAnglais->setPole($this->getReference(PoleFixtures::POLE_COURS, Pole::class));
        $prestationAnglais->setPhoto($this->getReference('photo-anglais', Photo::class));
        $manager->persist($prestationAnglais);
        $this->addReference(self::PRESTATION_ANGLAIS, $prestationAnglais);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            PoleFixtures::class,
            PhotoFixtures::class,
        ];
    }
}