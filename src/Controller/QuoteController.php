<?php

namespace App\Controller;

use App\Entity\Quote;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\QuoteRepository;

final class QuoteController extends AbstractController
{
    #[Route('/quote', name: 'app_quote')]

    public function index(QuoteRepository $quoteRepository): Response
    {
        return $this->render('quote/index.html.twig', [
            'quotes' => $quoteRepository->findAll(),
        ]);
    }
    #[Route('quote/{id}', name: 'app_quote_show')]
    public function show(Quote $quote): Response
    {
        return $this->render('quote/show.html.twig', [
            'quote' => $quote,
        ]);
    }
}
