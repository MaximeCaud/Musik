<?php
namespace AppBundle\DataFixtures;


use AppBundle\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    const CATEGORY_DEFAULT ='category-default';

    public function load(ObjectManager $manager)
    {
        $categories = array('Concert','Sortie','Meeting','Clip','Musique');
        $for = array('News','News','News','Media','Media');
        for ($i = 0; $i < count($categories); $i++)
        {
            $category = new Category();
            $category->setName($categories[$i]);
            $category->setType($for[$i]);
            $manager->persist($category);
        }
        $manager->flush();
        $this->addReference(self::CATEGORY_DEFAULT, $category);
    }
}