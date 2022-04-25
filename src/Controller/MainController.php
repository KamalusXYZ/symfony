<?php

namespace App\Controller;

use App\Repository\ContinentRepository;
use App\Repository\CountryRepository;
use Proxies\__CG__\App\Entity\Continent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(CountryRepository $countryRepository, ContinentRepository $continentRepository): Response
    {
        return $this->render('main/index.html.twig',
            ['countries' => $countryRepository->findAll(), 'continents' => $continentRepository->findAll()

            ]);
    }

    #[Route('/singleContinent/{id}', name: 'singleContinent', methods: ['GET'])]
    public function singleContinent(Continent $cont, CountryRepository $countries, ContinentRepository $continents): Response
    {

        return $this->render('singleContinent.html.twig',
                                ['cont' => $cont,
                                 'countries' => $countries->findAll(),
                                'continents' => $continents->findAll(),

            ]);
    }
}


