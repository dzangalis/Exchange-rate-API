<?php

$input = readline("Please enter your currencies amount [ex. 100 eur]: ");
[$amount, $currency] = explode(' ', $input);
$amount = (float)$amount;
$currency = trim(strtolower($currency));
if (empty($amount) === true || $amount < 0) {
    echo "Invalid amount." . PHP_EOL;
    exit();
}
$currency = strtolower($currency);
if (empty($currency) === true) {
    echo "Invalid currency." . PHP_EOL;
    exit();
}

$currencyData = file_get_contents(
    "https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/$currency.json"
);
$data = json_decode($currencyData);

$currencyChange = strtolower(readline("Input a currency type: "));

if ($currency === $currencyChange) {
    echo "Both currencies are the same, input a different currency!";
    exit;
}

if (isset($data->$currency->$currencyChange)) {
    $exchangeAmount = $amount * $data->$currency->$currencyChange;
    echo "The exchange from $amount $currency to $currencyChange is: " .
        $exchangeAmount .
        " " .
        $currencyChange .
        PHP_EOL;
} else {
    echo "Currency type not found, please enter a valid currency." . PHP_EOL;
}
