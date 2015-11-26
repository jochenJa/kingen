<?php

namespace domain\blueprint;

class Round
{
    private $hands = [];

    public function addHand(Hand ...$hand) { $this->hands = array_merge($this->hands, $hand); }
    public function hands() { return $this->hands; }
}