<?php
namespace AppBundle\DataFixtures;

use AppBundle\Entity\Media;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class MediaFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
       $media = new Media();
       $media->setCategory($this->getReference(CategoryFixtures::CATEGORY_DEFAULT));
       $media->setAuthor($this->getReference(AuthorFixtures::ADMIN_AUTHOR_REFERENCE));
       $media->setPublishedAt(new \DateTime("now"));
       $media->setName('Clip 123');
       $media->setUrl('https://www.youtube.com/embed/Xob79gGZcyA');
       $manager->persist($media);
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