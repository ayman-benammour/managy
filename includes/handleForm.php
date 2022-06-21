<?php

$name = '';
$price = 0;
$dateText = '';

$errorMessages = [];

if(!empty($_POST))
{
    // Debug
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';

    // Sanatize data
    $name = trim(htmlentities($_POST['name']));
    $price = (int)$_POST['price'];
    $dateText = trim(htmlentities($_POST['dateText']));

    /**
     * Errors
     */
    // Name
    if(empty($name))
    {
        $errorMessages[] = 'Missing name';
    }
    else if(strlen($name) > 20)
    {
        $errorMessages[] = 'Name should be 20 chars long max';
    }

    // Price
    if(empty($price))
    {
        $errorMessages[] = 'Missing price';
    }
    else if(strlen($price) > 20)
    {
        $errorMessages[] = 'Price should be 20 chars long max';
    }

    // Date
    if(empty($dateText))
    {
        $errorMessages[] = 'Missing date';
    }
    else if(strlen($dateText) > 20)
    {
        $errorMessages[] = 'Price should be 20 chars long max';
    }

    // Success
    if(empty($errorMessages))
    {
        // Insert into DB
        $prepare = $pdo->prepare('
            INSERT INTO
                expenses (name, price, date)
            VALUES
                (:name, :price, :date)
        ');
        $prepare->execute([
            'name' => $name,
            'price' => $price,
            'date' => $dateText,
        ]);

        // Reset values
        $name = '';
        $price = 0;
        $dateText = '';
    }
}