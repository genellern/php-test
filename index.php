<?php

require_once('Movie.php');
require_once('Rental.php');
require_once('Customer.php');

// TODO Missing grouping rental in single bill/case.
$rental1 = new Rental(
    new Movie(
        'Back to the Future',
        Movie::CHILDREN
    ), 4
);

$rental2 = new Rental(
    new Movie(
        'Office Space',
        Movie::REGULAR
    ), 3
);

$rental3 = new Rental(
    new Movie(
        'The Big Lebowski',
        Movie::NEW_RELEASE
    ), 5
);

$customer = new Customer('Joe Schmoe');

$customer->addRental($rental1);
$customer->addRental($rental2);
$customer->addRental($rental3);

echo $customer->statement();
