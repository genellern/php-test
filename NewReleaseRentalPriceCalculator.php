<?php

class NewReleaseRentalPriceCalculator extends RentalPriceCalculator
{
    /**
     * @inheritDoc
     */
    protected function calculate(): void
    {
        $this->total = $this->rental->daysRented() * 3;
    }
}