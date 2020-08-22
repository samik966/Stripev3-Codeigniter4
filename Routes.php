<?php

// To show the payment form
$routes->get('payments', 'Payments::new');

// Submit payment form with post request
$routes->post('payments', 'Payments::create');
