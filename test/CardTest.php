<?php

namespace test;

use domain\Card;

class CardTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function card_exsists_of_a_kind_and_a_value()
    {
        $card = new Card('H', '2');
        $this->assertSame('H2', $card->kind().$card->value());
    }
}
