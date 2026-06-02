<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminLoggedTest extends WebTestCase
{
    public function testAdminAccessWhenLogged(): void
    {
        $client = static::createClient();

        $container = static::getContainer();

        $userRepository = $container->get(UserRepository::class);

        $user = $userRepository->findOneBy([
            'email' => 'admin@honeygroup.com'
        ]);

        $client->loginUser($user);

        $client->request('GET', '/admin');

        $this->assertResponseIsSuccessful();
    }
}