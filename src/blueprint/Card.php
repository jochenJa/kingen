<?php

namespace domain\blueprint;

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
        $this->guardKind($kind);
        $this->guardValue($value);

        $this->kind = $kind;
        $this->value = $value;
    }

    /**
     * @param string $kind
     */
    private function guardKind($kind)
    {
        \Assert\that($kind)->string()->minLength(1);
    }

    /**
     * @param string $value
     */
    private function guardValue($value)
    {
        \Assert\that($value)->string()->minLength(1);
    }

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

    public function __toString() { return $this->kind().$this->value(); }
}