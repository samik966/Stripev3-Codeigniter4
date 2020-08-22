# Codeigniter 4 Stripe Payment Gateway :credit_card:

This repo is implementation of `Stripe/stripe-php` library, with **Codeigniter v4**. Here we are going to implement the **card based payments**. It just includes the Controller, model and the view files which you can easily place them in your project

# Requirements

PHP 7.0 and later for Codeingiter 4  
Codeigniter 4 framework  
`Stripe/stripe-php` library

## Steps to integrate Stripe payment gateway

### 1. Install Codeigniter and Stripe Library

### Composer

You can install `Codeigniter 4` and `Stripe/stripe-php` library via [Composer](https://getcomposer.org)

To install **Codeigniter 4** via composer, run the following command in a terminal:

`composer create-project codeigniter4/appstarter project-root`

The command above will create a **project-root** folder.

### 2. Generate API keys

In order to use stripe v3 library, you need to generate api keys, for your application.  
For this purpose, Create an account on [Stripe](https://stripe.com), and generate the keys.  
For more information, visit Stripe [documentation](https://stripe.com/docs)

### 3. Copy the files

Once the api keys are generated:  
Copy the `assets` folder to your Codeigniter application's `public/` folder.  
Copy the `Payments.php` controller file to the `app/Controllers` folder.  
Copy the `Paymentmodel.php` model file to the `app/Models` folder.  
Copy the `payment.php` controller file to the `app/Views` folder.  
Copy the `Routes.php` route content to your `app/Config/Routes.php` file.

### 4. Use the API Keys

In `assets/js/client.js` file, add the PUBLISHABLE API KEY

```javascript
var stripe = Stripe("Your PUBLISHABLE API Key Here");
```

In `Payments.php` Controller add the Secret API key at `line No. 44`

```php
\Stripe\Stripe::setApiKey('Your SECRET API key Here');
```

Now the Keys have been placed. It's time to setup the database.

### 5. Setup Database for Payments.

Since we are taking Name and Phone as an additional user Input  
So we have `pay_customer` table to store customer details  
and, `pay_transactions` to store transaction details.

Copy the content of the `assets/payment.sql` file and run in the Phpmyadmin sql server (or whatever mysql based server you might be using)  
Now the tables are setup.

It's time to run the application

### 6. Finish

To access the form we have `/payment` route. After it's submission you will see an alert Confirming the payment.

You can also see the transaction details in your [Stripe Dashboard](https://stripe.com/dashboard).  
And it's done... :v: :metal:
