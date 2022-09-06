<?php

class RegularRentalPriceCalculator extends RentalPriceCalculator
{

    /**
     * @inheritDoc
     */
    protected function calculate(): void
    {
        $this->total = 2;
        if ($this->rental->daysRented() > 2) {
            $this->total += ($this->rental->daysRented() - 2) * 1.5;
        }
    }
}