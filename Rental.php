<?php

class Rental
{
    private float $total = 0;
    private int $frequentRenterPoints = 0;

    public const PRICE_CATEGORY_CHILDREN = 2;
    public const PRICE_CATEGORY_REGULAR = 0;
    public const PRICE_CATEGORY_NEW_RELEASE = 1;

    /**
     * @var int
     */
    private int $priceCode;

    /**
     * @var Movie
     */
    private Movie $movie;

    /**
     * @var int
     */
    private int $daysRented;

    /**
     * @param Movie $movie
     * @param int $daysRented
     */
    public function __construct(Movie $movie, int $daysRented, int $priceCode)
    {
        $this->movie = $movie;
        $this->daysRented = $daysRented;
        $this->priceCode = $priceCode;
        $priceCalculator = $this->loadPriceCalculator();
        $this->total = $priceCalculator->getTotal();
    }

    /**
     * @return Movie
     */
    public function movie(): Movie
    {
        return $this->movie;
    }

    /**
     * @return int
     */
    public function daysRented(): int
    {
        return $this->daysRented;
    }

    private function loadPriceCalculator(): RentalPriceCalculator
    {
        return match ($this->priceCode) {
            self::PRICE_CATEGORY_CHILDREN    => new ChildrenRentalPriceCalculator($this),
            self::PRICE_CATEGORY_NEW_RELEASE => new NewReleaseRentalPriceCalculator($this),
            self::PRICE_CATEGORY_REGULAR     => new RegularRentalPriceCalculator($this),
            default                          => new RentalPriceCalculator($this)
        };
    }

    /**
     * @return int
     */
    public function getFrequentRenterPoints(): int
    {
        $this->frequentRenterPoints++;
        if ($this->priceCode() === self::PRICE_CATEGORY_NEW_RELEASE &&
            $this->daysRented() > 1) {
            $this->frequentRenterPoints++;
        }
        return $this->frequentRenterPoints;
    }

    /**
     * @return float|int
     */
    public function getTotal(): float|int
    {
        return $this->total;
    }


    /**
     * @return int
     */
    public function priceCode(): int
    {
        return $this->priceCode;
    }

}
