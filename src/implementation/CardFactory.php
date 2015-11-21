<?php

namespace domain\implementation;

use domain\blueprint\Card;
use domain\blueprint\CardFactoryInterface;

class CardFactory implements CardFactoryInterface
{
    private $values = "123456789XBDH";
    private $kinds = "HRSK";

    /**
     * @return Card[]
     */
    public function generateCards()
    {
        $cards = [];
        foreach(str_split($this->kinds) as $kind) {
            foreach(str_split($this->values)  as $value) {
                $cards[] = new Card($kind, $value);
            }
        }

        return $cards;
    }
}