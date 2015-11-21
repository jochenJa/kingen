<?php

namespace domain;

use domain\blueprint\Card;
use domain\blueprint\CardFactoryInterface;
use domain\blueprint\DeckInterface;

class CardDeck implements DeckInterface
{
    /**
     * @var CardFactoryInterface
     */
    private $cardFactory;
    private $deck;

    /**
     * CardDeck constructor.
     * @param CardFactoryInterface $cardFactory
     */
    public function __construct(CardFactoryInterface $cardFactory)
    {
        $this->cardFactory = $cardFactory;
        $this->reset();
    }

    /**
     * @inheritdoc
     */
    public function drawCard() { return array_pop($this->deck); }

    /**
     * @inheritdoc
     */
    public function drawCards($count)
    {
        if($count < 1) return [];

        $drawn = [];
        while($count > 0) {
            $drawn[] = $this->drawCard();
            $count--;
        }

        return $drawn;
    }

    /**
     * @inheritdoc
     */
    public function shuffle()
    {
        if(! $this->hasCards()) $this->reset();

        $deckWithKeys = array_combine(
            array_map(function(Card $card) { return (string)$card; }, $this->deck),
            $this->deck
        );

        $this->deck = array_map(
            function($randomCardKey) use ($deckWithKeys) { return $deckWithKeys[$randomCardKey]; },
            array_rand($deckWithKeys, count($deckWithKeys))
        );
    }

    /**
     * @inheritdoc
     */
    public function hasCards() { return count($this->deck) > 0; }
    public function reset() { $this->deck = $this->cardFactory->generateCards(); }
}