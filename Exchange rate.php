<?php

$currencyData = file_get_contents("https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/eur.json");
$data = json_decode($currencyData, true);

$input = readline("Please enter your currencies amount [ex. 3 eur]: ");
$inputParts = explode(' ', $input);
$amount = (float)$inputParts[0];
$currency = strtolower($inputParts[1]);

if (empty($amount) === true || $amount < 0) {
    echo "Invalid amount." . PHP_EOL;
    exit;
}
$currency = strtolower($currency);
if (empty($currency) === true) {
    echo "Invalid currency." . PHP_EOL;
    exit;
}

$currencyChange = strtolower(readline("Input a currency type: "));
if (isset($data['eur'][$currency]) && isset($data['eur'][$currencyChange])) {
    if ($currency !== "eur") {
        $exchangeAmount = ($amount / $data['eur'][$currency]) * $data['eur'][$currencyChange];
    } elseif ($currency == "eur") {
        $exchangeAmount = $amount * $data['eur'][$currencyChange];
    }
    echo "The exchange from $amount $currency to $currencyChange is: " . $exchangeAmount . " " . $currencyChange . PHP_EOL;
} else {
    echo "Currency type not found, please enter a valid currency." . PHP_EOL;;
}