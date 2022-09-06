<?php

class RentalPriceCalculator
{
    protected float $total = 0;
    private string $priceCode;
    protected Rental $rental;

    public function __construct(string $priceCode)
    {
        $this->priceCode = $priceCode;
    }

    /**
     * Calculate rental total by category.
     *
     * @return void
     */
    protected function calculate(): void
    {
        $this->total += ($this->rental->daysRented() - 2) * 1;
    }
}