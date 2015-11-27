<?php

namespace test;

use domain\blueprint\Card;
use domain\blueprint\Dealer;
use domain\blueprint\Hand;

class DealerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function one_hand_takes_one_card()
    {
        $card = new Card('x', 'y');
        $hand = new Hand();
        $dealer = new Dealer($this->mockedDeckWillReturn([$card]), 1);

        $dealer->deal($hand);

        $cards = $hand->cards();
        $this->assertCount(1, $cards);
        $this->assertContains($card, $cards);
    }

    /**
     * @test
     */
    public function three_hands_take_each_two_and_three_cards()
    {
        $hands = [new Hand(), new Hand(), new Hand()];
        $deck = $this->mockedDeckWillReturn(
            [new Card('1','1'), new Card('2','2')],
            [new Card('1','1'), new Card('2','2')],
            [new Card('1','1'), new Card('2','2')],
            [new Card('5','5'), new Card('4','4'), new Card('3','3')],
            [new Card('5','5'), new Card('4','4'), new Card('3','3')],
            [new Card('5','5'), new Card('4','4'), new Card('3','3')]
        );

        $dealer = new Dealer($deck, 2, 3);
        $dealer->deal(...$hands);

        $this->assertSame(
            '555',
            implode('',array_map(
                function(Hand $hand) { return count($hand->cards()); },
                $hands
            ))
        );
    }

    /**
     * @param $returns
     * @return \domain\blueprint\DeckInterface
     */
    private function mockedDeckWillReturn(...$returns) {
        $mock = $this->getMockBuilder('domain\blueprint\DeckInterface')
            ->getMock();
        $mock
            ->expects($this->any())
            ->method('drawCards')
            ->willReturnOnConsecutiveCalls(...$returns)
        ;

        return $mock;
    }
}