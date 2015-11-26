<?php

namespace domain\implementation;

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
    public function drawCard()
    {
        if(! $this->hasCards()) throw new OutOfCardsException();

        return array_shift($this->deck);
    }

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

        shuffle($this->deck);
    }

    /**
     * @inheritdoc
     */
    public function hasCards() { return count($this->deck) > 0; }
    public function reset() { $this->deck = $this->cardFactory->generateCards(); }
}

class OutOfCardsException extends \Exception {}