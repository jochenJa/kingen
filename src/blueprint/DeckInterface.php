<?php

namespace domain\blueprint;

interface DeckInterface
{
    /**
     * @return Card;
     * @throws OutOfCardsException
     */
    public function drawCard();

    /**
     * @param integer $count
     * @return Card[];
     * @throws OutOfCardsException
     */
    public function drawCards($count);

    public function shuffle();

    /**
     * @return boolean
     */
    public function hasCards();

    public function reset();

}

class OutOfCardsException extends \Exception {}