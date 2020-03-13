<?php

namespace App\Controller;

use App\Entity\Voyage;
use App\Repository\VoyageRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VoyagesController extends AbstractController
{
    /**
     * @Route("/voyages", name="voyages")
     */
    public function index(VoyageRepository $voyageRepo)
    {
        
        return $this->render('voyages/index.html.twig', [
            'controller_name' => 'VoyagesController',
            'voyages' => $voyages = $voyageRepo->findAll()
        ]);
    }

 /**
 * @Route("/voyages/{id}", name="voyages_show")
 */
public function show(Voyage $voyage)
{
    return $this->render('voyages/show.html.twig', [
        'voyage' => $voyage
    ]);
}

}
