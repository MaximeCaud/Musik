<?php
namespace AppBundle\DataFixtures;


use AppBundle\Entity\News;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class NewsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 4; $i++)
        {
            $news = new News();
            $news->setAuthor($this->getReference(AuthorFixtures::ADMIN_AUTHOR_REFERENCE));
            $news->setCreatedAt(new \DateTime("now"));
            $news->setContent('dfgdfgdfg');
            $news->setTitle('Ceci est un titre');
            $news->setCategory($this->getReference(CategoryFixtures::CATEGORY_DEFAULT));
            $manager->persist($news);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            AuthorFixtures::class,
            CategoryFixtures::class,
        );
    }
}