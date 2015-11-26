<?php

namespace domain\blueprint;

class Hand
{
    private $cards = [];

    public function takes(Card ...$cards)
    {
        $this->cards = array_merge($this->cards, $cards);
    }

    public function cards()
    {
        return $this->cards;
    }
}