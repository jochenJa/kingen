<?php
namespace domain\blueprint;

Interface CardFactoryInterface
{
    /**
     * @return Card[]
     */
    public function generateCards();
}