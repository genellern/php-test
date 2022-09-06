<?php

require_once('Movie.php');
require_once('Rental.php');
require_once('Customer.php');
require_once('RentalPriceCalculator.php');
require_once('ChildrenRentalPriceCalculator.php');
require_once('NewReleaseRentalPriceCalculator.php');
require_once('RegularRentalPriceCalculator.php');

// TODO Missing grouping rental in single bill/case.
$rental1 = new Rental(
    new Movie('Back to the Future'),
    4,
    Rental::PRICE_CATEGORY_CHILDREN
);

$rental2 = new Rental(
    new Movie('Office Space'),
    3,
    Rental::PRICE_CATEGORY_REGULAR
);

$rental3 = new Rental(
    new Movie('The Big Lebowski'),
    5,
    Rental::PRICE_CATEGORY_NEW_RELEASE
);

$customer = new Customer('Joe Schmoe');

$customer->addRental($rental1);
$customer->addRental($rental2);
$customer->addRental($rental3);

echo $customer->statement();
