<?php

namespace App\DataFixtures;

use App\Entity\Ad;
use Faker\Factory;
use App\Entity\Image;
//use Cocur\Slugify\Slugify;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');
        //$slugify = new Slugify();
        
        for($a = 1; $a <= 30; $a++){
            $ad = new Ad();
            $brand = $faker->sentence();
            //$slug = $slugify->slugify($brand);
            //$image = $faker->imageUrl(1000,350);
            $model = $faker->paragraph(2);
            $description = '<p>'.join('</p><p>',$faker->paragraphs(1)).'</p>';
            //$numberOfOwners = $faker->rand(1,3);
            //$displacement = $faker->rand(400,1000);
            //$power = $faker->rand(1000,20000);
            $fuel = $faker->sentence();
            $circulationYear = $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null);
            $transmission = $faker->sentence();
            $othersOption = '<p>'.join('</p><p>',$faker->paragraphs(1)).'</p>';

            

            $ad->setBrand($brand)
                ->setImage('https://picsum.photos/1000/350')
                ->setModel($model)
                ->setDescription($description)
                ->setPrice(rand(400,20000))
                ->setKm(rand(1,5))
                ->setNumberOfOwners(rand(1,3))
                ->setDisplacement(rand(400,1000))
                ->setPower(rand(1000,20000))
                ->setFuel($fuel)
                ->setCirculationYear($circulationYear)
                ->setTransmission($transmission)
                ->setOthersOption($othersOption);

                
                

            $manager->persist($ad);    

            for($i=1; $i <= rand(2,5); $i++){
                $image = new Image();
                $image->setUrl('https://picsum.photos/200/200')
                    ->setCaption($faker->sentence())
                    ->setAd($ad);
                $manager->persist($image);    
            }
        }
        $manager->flush();
    }
}