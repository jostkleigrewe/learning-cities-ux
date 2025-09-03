<?php
// src/Controller/CityController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CityController extends AbstractController
{
    #[Route('/
    ', name: 'city_index')]
    public function index(Request $request): Response
    {
        $q = trim((string) $request->query->get('q', ''));
        $cities = array_filter([
            'Berlin','Bonn','Bremen','Dortmund','Düsseldorf','Hamburg','Köln','Leipzig','München','Stuttgart'
        ], fn($c) => $q === '' || stripos($c, $q) !== false);

        // Render vollständige Seite: Suchfeld + Frame
        return $this->render('city/index.html.twig', [
            'q' => $q,
            'cities' => $cities,
        ]);
    }
}
