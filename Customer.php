<?php

class Customer
{
    private int $frequentRenterPoints = 0;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Rental[]
     */
    private $rentals;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->rentals = [];
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @param Rental $rental
     */
    public function addRental(Rental $rental): void
    {
        $this->rentals[] = $rental;
    }

    /**
     * @return string
     */
    public function statement(): string
    {
        $totalAmount = 0;
        $frequentRenterPoints = 0;

        $result = 'Rental Record for ' . $this->name() . PHP_EOL;
        $result .= 'Amount owed is ' . $totalAmount . PHP_EOL;
        $result .= $this->processRentals();
//        $result .= "\t" . str_pad($rental->movie()->name(), 30, ' ', STR_PAD_RIGHT) . "\t" . $rental->getTotal() . PHP_EOL;
        $result .= 'You earned ' . $frequentRenterPoints . ' frequent renter points' . PHP_EOL;

        return $result;
    }

    private function processRentals(): string
    {
        $result = '';
        $total = 0;
        foreach ($this->rentals as $rental) {
            $total += $rental->getTotal();
            $this->frequentRenterPoints = $rental->getFrequentRenterPoints();
        }
        return $result;
    }
}
