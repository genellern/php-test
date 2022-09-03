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
Rental Record for {customerName}
Amount owed is {total}
{items}You earned {points} frequent renter points.\n
STRING_RENTAL_TEMPLATE;

    private const stringRentalDetailTemplate = <<<STRING_RENTAL_DETAIL_TEMPLATE
    \t%s\t%s\n
    STRING_RENTAL_DETAIL_TEMPLATE;

    private const htmlRentalTemplate = <<<HTML_RENTAL_TEMPLATE
    <h1>Rental Record for <em>{customerName}</em></h1>
    <ul>
    {items}</ul>
    <p>Amount owed is {total}</p>
    <p>You earned <em>{points}</em> frequent renter points</p>>\n
    HTML_RENTAL_TEMPLATE;

    private const htmlRentalDetailTemplate = <<<HTML_RENTAL_DETAIL_TEMPLATE
    <li>%s - %s</li>\n
HTML_RENTAL_DETAIL_TEMPLATE;

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
        foreach ($this->rentals as $rental) {
            $this->total += $rental->getTotal();
            $this->frequentRenterPoints += $rental->getFrequentRenterPoints();
        }
    }

    public function printStatement(bool $asString = true): string
    {
        $itemsDetail = "";
        $statementTemplate = $asString ? self::stringRentalTemplate : self::htmlRentalTemplate;
        $detailTemplate = $asString ? self::stringRentalDetailTemplate : self::htmlRentalDetailTemplate;
        $paddingLength = $asString ? 30 : 0;

        foreach ($this->rentals as $rental) {
            $itemsDetail .= sprintf(
                $detailTemplate,
                str_pad($rental->movie()->name(), $paddingLength, ' ', STR_PAD_RIGHT),
                $rental->getTotal()
            );
        }

        return strtr(
            $statementTemplate,
            [
                '{customerName}' => $this->name(),
                '{total}' => $this->total,
                '{items}' => $itemsDetail,
                '{points}' => $this->frequentRenterPoints
            ]
        );
    }
}
