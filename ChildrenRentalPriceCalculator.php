<?php

class ChildrenRentalPriceCalculator extends RentalPriceCalculator
{

    /**
     * @inheritDoc
     */
    protected function calculate(): void
    {
        $this->total = 1.5;
        if ($this->rental->daysRented() > 3) {
            $this->total += ($this->rental->daysRented() - 3) * 1.5;
        }
    }
}