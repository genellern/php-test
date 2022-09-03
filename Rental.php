<?php

class Rental
{
    private float $total = 0;
    private int $frequentRenterPoints = 0;

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
    public function __construct(Movie $movie, int $daysRented)
    {
        $this->movie = $movie;
        $this->daysRented = $daysRented;
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

    public function getTotal(): float
    {
        switch($this->movie()->priceCode()) {
            case Movie::REGULAR:
                $this->total += 2;
                if ($this->daysRented() > 2) {
                    $this->total += ($this->daysRented() - 2) * 1.5;
                }
                break;
            case Movie::NEW_RELEASE:
                $this->total += $this->daysRented() * 3;
                break;
            case Movie::CHILDREN:
                $this->total += 1.5;
                if ($this->daysRented() > 3) {
                    $this->total += ($this->daysRented() - 3) * 1.5;
                }
                break;
        }
        return $this->total;
    }

    /**
     * @return int
     */
    public function getFrequentRenterPoints(): int
    {
        $this->frequentRenterPoints++;
        if ($this->movie()->priceCode() === Movie::NEW_RELEASE &&
            $this->daysRented() > 1) {
            $this->frequentRenterPoints++;
        }
        return $this->frequentRenterPoints;
    }
}
