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

    /**
     * @test
     */
    public function cards_are_equal_when_kind_and_value_are_the_same()
    {
        $card = new Card('H', '3');
        $cardWithDifferentKind = new Card('R', '3');
        $cardWithDifferentValue = new Card('H', '9');
        $cardWithDifferentKindAndValue = new Card('R', '9');

        $this->assertTrue($card->equals($card));
        $this->assertFalse($card->equals($cardWithDifferentKind));
        $this->assertFalse($card->equals($cardWithDifferentValue));
        $this->assertFalse($card->equals($cardWithDifferentKindAndValue));
    }
}
