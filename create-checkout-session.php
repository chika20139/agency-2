<?php

include './stripe-php/init.php';
//require 'vendor/autoload.php';
// This is your test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51M8opFCU6W5jQTsRulf9ZJxkrgeNtHjXNoMnZHM3Y5727Os5iTISJayQfxFJn5d7VzB5NBdX22PULAF5cTpOflrh00hsItB3cM');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost/phpShoppingCart/config/';

$checkout_session = \Stripe\Checkout\Session::create([
  'line_items' => [
    [
      'price_data' => [
        'currency' => 'usd',
        'product_data' => ['name' => 'Apple MacBook Pro 13 pouces Puce Apple M1 - 512 Go - Clavier Azerty - Gris Sidéral'],
        'unit_amount' => 6000,
      ],
      'quantity' => 1,
    ],
  ],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . 'place_order.php',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);