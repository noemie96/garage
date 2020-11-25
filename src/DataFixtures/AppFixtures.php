<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Faker\Factory;
use Cocur\Slugify\Slugify;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');
        $slugify = new Slugify();

        for($a = 1; $a <= 30; $a++){
            $ad = new Ad();
            $brand = $faker->sentence();
            $slug = $slugify->slugify($brand);
            $Image = $faker->imageUrl(1000,350);
            $model = $faker->paragraph(2);
            $description = '<p>'.join('</p><p>',$faker->paragraphs(5)).'</p>';

            $ad->setBrand($brand)
                ->setSlug($slug)
                ->setImage($Image)
                ->setModel($model)
                ->setDescription($description)
                ->setPrice(rand(400,20000))
                ->setKm(rand(1,5));

            $manager->persist($ad);    

        }
        $manager->flush();
    }
}
