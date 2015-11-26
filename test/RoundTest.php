<?php

namespace test;

use domain\blueprint\Dealer;
use domain\blueprint\Hand;
use domain\blueprint\Round;
use domain\implementation\CardDeck;
use domain\implementation\CardFactory;

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

    /**
     * @test
     */
    public function a_dealer_will_divide_a_deck_among_hands()
    {
        $deck = $this->fiftyTwoCards();
        $round = new Round();
        $round->addHand(new Hand(), new Hand(), new Hand(), new Hand());

        $round->fillHands(new Dealer($deck, 13));

        $this->assertFalse($deck->hasCards());
        $this->assertSame(
            [13, 13, 13, 13],
            array_map(
                function(Hand $hand) { return $hand->countCards(); },
                $round->hands()
            )
        );
    }

    private function fiftyTwoCards() { return new CardDeck(new CardFactory()); }
}