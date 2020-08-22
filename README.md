# Codeigniter 4 Stripe Payment Gateway :credit_card:

This repo is implementation of `Stripe/stripe-php` library, with **Codeigniter v4**. It just includes the Controller, model and the view files which you can easily place them in your project

# Requirements

PHP 7.0 and later for Codeingiter 4
Codeigniter 4 framework
`Stripe/stripe-php` library

## Steps to integrate Stripe payment gateway

## 1. Install Codeigniter and Stripe Library

### Composer

You can install `Codeigniter 4` and `Stripe/stripe-php` library via [Composer](getcomposer.org)

To install **Codeigniter 4** via composer, run the following command in a terminal:
`composer create-project codeigniter4/appstarter project-root`
The command above will create a **project-root** folder.

## 2. Generate API keys

In order to use stripe v3 library, you need to generate api keys, for your application.
For this purpose, Create an account on [Stripe](stripe.com), and generate the keys.
For more information, visit Stripe [documentation](stripe.com/docs)

## 3. Copy the files

Once the api keys are generated copy the `assets` folder to your Codeigniter application's `public/` folder.
Copy the `Payments.php` controller file to the `app/Controllers` folder.
Copy the `Paymentmodel.php` model file to the `app/Models` folder.
Copy the `payment.php` controller file to the `app/Views` folder.
Copy the `Routes.php` route content to your `app/Config/Routes.php` file.

## 4. Use the API Keys

In `assets/js/client.js` file, paste the PUBLISHABLE API KEY

```javascript
var stripe = Stripe("Your Public Key Here");
```

In `Payments.php` Controller add the Secret ApI key at Line No. 44

```php
\Stripe\Stripe::setApiKey('YOUR SECRET API KRY HERE');
```

Now the Keys have been setup. It's time to setup the database.

## 5. Setup Database for Payments.

Since we are taking Name and Phone as user Input
so we hae `pay_customer` table to store customer details
and `pay_transactions` to store transaction details.

Copy the content of content of the `assets/payment.sql` file and run in the Phpmyadmin sql server (or whatever mysql based serve you might be using)
Now the tables are setup.

It's time to run the application

## 6. Finish

To access the form we have `/payment` route. After it's submission you will see an alert Confirming the payment.

You can also see the transaction details in your [stripe](stripe.com/dashboard) Dashboard.
And it's done... :v: :metal:
