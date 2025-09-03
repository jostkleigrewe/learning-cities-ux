<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TablerExampleController extends AbstractController
{
    /**
     * Demonstrates Tabler dropdown components.
     *
     * The template shows several dropdown variants from https://docs.tabler.io/ui/components/dropdowns
     * and includes short notes on how the required JS is loaded in this project.
     */
    #[Route('/examples/tabler/dropdowns', name: 'tabler_examples_dropdowns')]
    public function dropdowns(): Response
    {
        return $this->render('tabler/examples/dropdowns.html.twig');
    }
}
