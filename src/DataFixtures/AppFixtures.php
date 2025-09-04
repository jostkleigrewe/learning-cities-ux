<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\District;
use App\Entity\Place;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\AsciiSlugger;

final class AppFixtures extends Fixture
{
    public function load(ObjectManager $om): void
    {
        $slugger = new AsciiSlugger();

        $data = [
            'Berlin' => [
                'Mitte' => [
                    ['Brandenburger Tor', 'landmark', 'Pariser Platz'],
                    ['Museumsinsel', 'museum', 'Bodestr. 1-3'],
                ],
                'Friedrichshain-Kreuzberg' => [
                    ['East Side Gallery', 'sight', 'Mühlenstr.'],
                ],
            ],
            'München' => [
                'Altstadt-Lehel' => [
                    ['Marienplatz', 'square', 'Marienplatz 1'],
                ],
            ],
            'Warendorf' => [
                'Altstadt' => [
                    ['Martkplatz', 'square', 'Marktplatz 1'],
                    ['Gymnasium Laurentianum', 'education', 'Von-Ketteler-Straße 24'],
                ],
            ],
        ];

        foreach ($data as $cityName => $districts) {
            $city = (new City())
                ->setName($cityName)
                ->setSlug(strtolower($slugger->slug($cityName)))
                ->setPopulation(null);

            $om->persist($city);

            foreach ($districts as $districtName => $places) {
                $district = (new District())
                    ->setName($districtName)
                    ->setSlug(strtolower($slugger->slug($districtName)))
                    ->setCity($city);

                $om->persist($district);

                foreach ($places as [$placeName, $cat, $addr]) {
                    $place = (new Place())
                        ->setName($placeName)
                        ->setSlug(strtolower($slugger->slug($placeName)))
                        ->setCategory($cat)
                        ->setAddress($addr)
                        ->setDistrict($district);

                    $om->persist($place);
                }
            }
        }

        $om->flush();
    }
}
