<?php

namespace test;

class RoundTest extends \PHPUnit_Framework_TestCase
{
    public function add_a_hand_to_a_round()
    {
        $handPlayer1 = new Hand();
        $handPlayer2 = new Hand();

        $round = new Round();
        $round->addHand($handPlayer1);
        $round->addHand($handPlayer2);

        // expected
        $this->assertCount(2, $round->hands());
    }

    public function a_croupier_will_divide_a_carddeck_among_hands()
    {
        /*
        $round->fillHands(
            new Croupier(new CardDeck(), 4, 5, 4)
        )
        );
        */

        //expected
        // each hand will have 13 cards.
        // deck is empty.
    }
}