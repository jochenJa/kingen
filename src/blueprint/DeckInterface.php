<?php

namespace domain\blueprint;

interface DeckInterface
{
    /**
     * @return Card;
     */
    public function drawCard();

    /**
     *
     * @param integer $count
     * @return Card[] ;
     */
    public function drawCards($count);

    public function shuffle();

    /**
     * @return boolean
     */
    public function hasCards();

    public function reset();

}