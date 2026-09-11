<?php

namespace App\Controller;

use App\Entity\Quote;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\QuoteRepository;
use App\Form\QuoteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

final class QuoteController extends AbstractController
{
    #[Route('/quote', name: 'app_quote')]

    public function index(QuoteRepository $quoteRepository): Response
    {
        return $this->render('quote/index.html.twig', [
            'quotes' => $quoteRepository->findAll(),
        ]);
    }

    #[Route('/quote/new', name: 'app_quote_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $quote = new Quote();
        $form = $this->createForm(QuoteType::class, $quote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($quote);
            $entityManager->flush();

            return $this->redirectToRoute('app_quote');
        }

        return $this->render('quote/new.html.twig', [
            'form' => $form,
        ]);
    }
    #[Route('quote/{id}', name: 'app_quote_show')]
    public function show(Quote $quote): Response
    {
        return $this->render('quote/show.html.twig', [
            'quote' => $quote,
        ]);
    }

    #[Route('/quote/{id}/edit', name: 'app_quote_edit')]
    public function edit(Request $request, Quote $quote, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(QuoteType::class, $quote);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_quote');
        }

        return $this->render('quote/edit.html.twig', [
            'form' => $form, 'quote' => $quote,
        ]);
    }

    #[Route('/quote/{id}/delete', name: 'app_quote_delete', methods: ['POST'])]
    public function delete(Request $request, Quote $quote, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quote->getId(), $request->request->get('_token'))) {
            $entityManager->remove($quote);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_quote');

    }


}
