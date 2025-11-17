<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Snippet;
use App\Entity\User;
use App\Factory\CommentFactory;
use App\Factory\SnippetFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{        

    public function load(ObjectManager $manager): void
    {
        // $user = new User();
        // $user->setName('Test User');
        // $user->setEmail('j@admin.com');
        // $passwordHasher = $this->passwordHasher->hashPassword($user, 'password');
        // $user->setPassword($passwordHasher);

        UserFactory::createOne([
            'email' =>'j@admin.com',
        ]);

        UserFactory::createMany(9);
        SnippetFactory::createMany(50);
        CommentFactory::createMany(100);



    }
}
