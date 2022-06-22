<?php

$name = '';
$price = 0;
$dateText = '';
$category = '';

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

    // Category
    if(empty($category))
    {
        $errorMessages[] = 'Missing category';
    }
    else if(!array_key_exists($category, $categories))
    {
        $errorMessages[] = 'Wrong category';
    }

    // Success
    if(empty($errorMessages))
    {
        // Insert into DB
        $prepare = $pdo->prepare('
            INSERT INTO
                expenses (name, price, date, category)
            VALUES
                (:name, :price, :date, :category)
        ');
        $prepare->execute([
            'name' => $name,
            'price' => $price,
            'date' => $dateText,
            'category' => $category,
        ]);

        // Reset values
        $name = '';
        $price = 0;
        $dateText = '';
        $category = '';
    }
}