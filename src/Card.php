<?php

namespace domain;

class Card
{
    private $kind;
    private $value;

    /**
     * Card constructor.
     * @param string $kind
     * @param string $value
     */
    public function __construct($kind, $value)
    {
        $this->kind = $kind;
        $this->value = $value;
    }

    // add some guards for kind and value ?

    /**
     * cards need to be comparable
     * @param Card $other
     * @return bool
     */
    public function equals(Card $other)
    {
        return ($this->kind() === $other->kind() && $this->value() === $other->value());
    }

    public function kind() { return $this->kind; }
    public function value() { return $this->value; }
}