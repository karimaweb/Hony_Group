<?php

namespace App\DataFixtures;

use App\Entity\Photo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PhotoFixtures extends Fixture
{
    public const PHOTO_SAHARA = 'photo-sahara';
    public const PHOTO_ALGER = 'photo-alger';
    public const PHOTO_ANGLAIS = 'photo-anglais';

    public function load(ObjectManager $manager): void
    {
        $photos = [
            self::PHOTO_SAHARA => [
                'url' => 'sahara.jpg',
                'legende' => 'Circuit découverte du Sahara',
            ],
            self::PHOTO_ALGER => [
                'url' => 'alger.jpg',
                'legende' => 'Circuit culturel à Alger',
            ],
            self::PHOTO_ANGLAIS => [
                'url' => 'anglais.jpg',
                'legende' => 'Cours de langue anglaise',
            ],
        ];

        foreach ($photos as $reference => $data) {
            $photo = new Photo();
            $photo->setUrlFichier($data['url']);
            $photo->setLegende($data['legende']);

            $manager->persist($photo);
            $this->addReference($reference, $photo);
        }

        $manager->flush();
    }
}