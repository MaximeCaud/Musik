<?php
namespace AppBundle\DataFixtures;


use AppBundle\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class AuthorFixtures extends Fixture implements DependentFixtureInterface
{
    const ADMIN_AUTHOR_REFERENCE = 'admin-author';

    public function load(ObjectManager $manager)
    {
        $author = new Author();
        $author->setName('Admin');
        $author->setUser($this->getReference(UserFixtures::ADMIN_USER_REFERENCE));
        $author->setAvatar('avatar.png');

        $manager->persist($author);
        $manager->flush();

        $this->addReference(self::ADMIN_AUTHOR_REFERENCE, $author);
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}