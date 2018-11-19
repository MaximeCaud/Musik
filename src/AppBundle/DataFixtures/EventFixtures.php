<?php
namespace AppBundle\DataFixtures;


use AppBundle\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class EventFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 4; $i++)
        {
            $event = new Event();
            $event->setAdress('30 rue du test');
            $event->setTitle('Fixtures');
            $event->setAuthor($this->getReference(AuthorFixtures::ADMIN_AUTHOR_REFERENCE));
            $event->setDescription('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad dolores esse laborum libero maiores quos, suscipit. Consequatur culpa dignissimos doloribus ducimus et, eveniet excepturi, in ipsam numquam pariatur placeat porro possimus praesentium quam quod rem sit soluta, veniam. Assumenda beatae ea eligendi harum, iusto maiores nostrum optio sit temporibus veritatis.');
            $event->setPrice(25.5);
            $event->setCreatedAt(new \DateTime("now"));
            $event->setDate(new \DateTime("now"));
            $event->setUrl('#');

            $manager->persist($event);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
          AuthorFixtures::class,
        );
    }
}