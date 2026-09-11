<?php

namespace App\DataFixtures;

use App\Entity\Quote;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $quotesData = [
            [
                'content' => 'La roue tourne va tourner.',
                'author' => 'Franck Ribéry',
                'source' => 'Conférence de presse',
                'century' => 'XXIe',
                'language' => 'fr',
                'context' => 'Interview culte de l’équipe de France.',
                'aura' => 10_000_000,
            ],
            [
                'content' => 'Veni, vidi, vici.',
                'author' => 'Jules César',
                'source' => 'Guerre du Pont',
                'century' => 'Ier av. J.-C.',
                'language' => 'la',
                'context' => 'Message expédié au Sénat romain après la victoire rapide de Zéla.',
                'aura' => 9_500,
            ],
            [
                'content' => 'Il n’y a aucune raison pour qu’un individu ait un ordinateur chez lui.',
                'author' => 'Ken Olsen',
                'source' => 'Convention de la World Future Society',
                'century' => 'XXe',
                'language' => 'en',
                'context' => 'Fondateur de Digital Equipment Corporation, en 1977.',
                'aura' => -1_500,
            ],
        ];

        foreach ($quotesData as $quoteData) {
            $quote = new Quote();
            $quote->setContent($quoteData['content']);
            $quote->setAuthor($quoteData['author']);
            $quote->setSource($quoteData['source']);
            $quote->setCentury($quoteData['century']);
            $quote->setLanguage($quoteData['language']);
            $quote->setContext($quoteData['context']);
            $quote->setAura($quoteData['aura']);
            $manager->persist($quote);
        }
        $manager->flush();
    }
}
