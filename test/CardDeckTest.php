<?php

namespace test;

use domain\blueprint\Card;
use domain\implementation\CardDeck;
use domain\implementation\OutOfCardsException;

class CardDeckTest extends \PHPUnit_Framework_TestCase
{
    private $cards;
    /** @var Card */
    private $schoppenAas;
    /** @var Card */
    private $klaverDrie;
    /** @var Card */
    private $hartenNegen;
    /** @var Card */
    private $ruitenBoer;
    /** @var Card */
    private $klaverTien;
    private $factory;

    public function setUp()
    {
        $this->cards = [
            $this->schoppenAas = new Card('S','1'),
            $this->klaverDrie = new Card('K', '3'),
            $this->hartenNegen = new Card('H', '9'),
            $this->ruitenBoer = new Card('R', 'B'),
            $this->klaverTien = new Card('K', 'X'),
        ];

        $this->factory = $this->getMockBuilder('domain\blueprint\CardFactoryInterface')
            ->getMock()
        ;

        $this->factory
            ->method('generateCards')
            ->willReturn($this->cards)
        ;
    }

    /**
     * @param Card ...$cards
     * @return mixed
     */
    private function cardsAsText(Card ...$cards) { return implode('', $cards); }

    /**
     * @test
     * @throws OutOfCardsException
     */
    public function i_can_draw_a_card_from_the_deck()
    {
        $deck = new CardDeck($this->factory);
        $drawnCard = $deck->drawCard();

        $this->assertTrue($this->schoppenAas->equals($drawnCard));
    }

    /**
     * @test
     * @throws OutOfCardsException
     */
    public function i_can_draw_multiple_cards_at_once()
    {
        $deck = new CardDeck($this->factory);

        $this->assertSame(
            $this->cardsAsText(...$this->cards),
            $this->cardsAsText(...$deck->drawCards(5))
        );
    }

    /**
     * @test
     */
    public function shuffle_will_randomize_the_cards_in_the_deck()
    {
        $beforeShuffle = $this->cardsAsText(...$this->cards);

        $deck = new CardDeck($this->factory);
        $deck->shuffle();
        $afterShuffle = $this->cardsAsText(...$deck->drawCards(5));

        $this->assertEquals(strlen($beforeShuffle), strlen($afterShuffle));
        $this->assertNotSame($beforeShuffle, $afterShuffle);
    }
}