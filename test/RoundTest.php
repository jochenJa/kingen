<?php

namespace test;

use domain\blueprint\Hand;
use domain\blueprint\Round;

class RoundTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function add_a_hand_to_a_round()
    {
        $h1 = new Hand();
        $h2 = new Hand();

        $round = new Round();
        $round->addHand($h1, $h2);

        // expected
        $hands = $round->hands();
        $this->assertCount(2, $hands);
        $this->assertContains($h1, $hands);
        $this->assertContains($h2, $hands);
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