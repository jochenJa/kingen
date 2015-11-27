<?php

namespace domain\blueprint;

class Dealer
{
    /**
     * @var DeckInterface
     */
    private $deck;
    private $deals;

    /**
     * Dealer constructor.
     * @param DeckInterface $deck
     * @param $deals
     */
    public function __construct(DeckInterface $deck, ...$deals)
    {
        $this->deck = $deck;
        $this->deals = $deals;
    }

    /**
     * @param Hand ...$hands
     */
    public function deal(Hand ...$hands)
    {
        $hands = (array)$hands;
        foreach($this->deals as $count) {
            array_walk(
                $hands,
                function(Hand $hand) use ($count) {
                    $hand->takes(...$this->deck->drawCards($count));
                }
            );
        }
    }
}