<?php

class Customer
{
    private int $frequentRenterPoints = 0;
    private float $total = 0;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Rental[]
     */
    private $rentals;

    private const stringRentalTemplate = <<<STRING_RENTAL_TEMPLATE
Rental Record for %s
Amount owed is %s
%s
You earned %s frequent renter points.\n
STRING_RENTAL_TEMPLATE;

    private const stringRentalDetailTemplate = <<<STRING_RENTAL_DETAIL_TEMPLATE
    \t%s\t%s\n
    STRING_RENTAL_DETAIL_TEMPLATE;


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
     * @param bool $asString
     * @return string
     */
    public function statement(bool $asString = true): string
    {
        $this->processRentals();
        return $this->printStatement($asString);
    }

    private function processRentals(): void
    {
        $total = 0;
        foreach ($this->rentals as $rental) {
            $total += $rental->getTotal();
            $this->frequentRenterPoints += $rental->getFrequentRenterPoints();
        }
    }

    public function printStatement(bool $asString = true): string
    {
        $itemsDetail = "";
        foreach ($this->rentals as $rental) {
            $itemsDetail .= sprintf(
                self::stringRentalDetailTemplate,
                str_pad($rental->movie()->name(), 30, ' ', STR_PAD_RIGHT),
                $rental->getTotal()
            );
        }
        return sprintf(
            self::stringRentalTemplate,
            $this->name(),
            $this->total,
            $itemsDetail,
            $this->frequentRenterPoints
        );
    }
}
