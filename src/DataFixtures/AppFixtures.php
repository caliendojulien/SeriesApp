<?php

namespace App\DataFixtures;

use App\Entity\Serie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $listeFichiers = scandir("C:/Users/jcaliendo/Documents/SeriesApp/public/img/posters/series");
        foreach ($listeFichiers as $fichier) {
            if ($fichier != "." && $fichier != "..") {
                $serie = new Serie();
                $serie->setNom($fichier);
                $serie->setImage($fichier);
                $manager->persist($serie);
            }
        }
        $manager->flush();
    }
}
