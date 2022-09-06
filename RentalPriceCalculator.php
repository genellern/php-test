<?php

class RentalPriceCalculator
{
    protected float $total = 0;
    private string $priceCode;
    protected Rental $rental;

    public function __construct(Rental $rental)
    {
        $this->rental = $rental;
        $this->priceCode = $rental->priceCode();
        $this->calculate();
    }

    /**
     * @return float|int
     */
    public function getTotal(): float|int
    {
        return $this->total;
    }

    /**
     * Calculate rental total by category.
     *
     * @return void
     */
    protected function calculate(): void
    {
        $this->total += ($this->rental->daysRented() - 1);
    }
}
