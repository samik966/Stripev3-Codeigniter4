<?php

namespace App\Controllers;

use \Stripe\Stripe;
use Stripe\PaymentIntent;

use App\Models\Paymentmodel;
use App\Controllers\BaseController;

class Payments extends BaseController
{
    private $db;
    private $model;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->model = new Paymentmodel($this->db);
    }
    public function new()
    {
        $data['amount'] = '1500 INR';
        $data['course'] = 'Course Name';
        return view('Frontend/payment', $data);
    }

    public function create()
    {
        $this->validation->setRule('name', 'Name', 'required|min_length[3]|max_length[32]');
        $this->validation->setRule('phone', 'Phone', 'is_natural|min_length[10]|max_length[12]');
        $this->validation->setRule('stripeToken', 'Token', 'required');

        if ($this->validation->withRequest($this->request)->run()) {
            $name = $this->request->getPost('name');
            $phone = $this->request->getPost('phone');
            $token = $this->request->getPost('stripeToken');
            $amount = 1500;
            $currency = 'inr';
            $courseName = 'Course Name';
            $this->db->transStart();

            try {
                \Stripe\Stripe::setApiKey('YOUR SECRET API KRY HERE');

                $customer = \Stripe\Customer::create(array(
                    'name' => $name,
                    'phone' => $phone,
                    'source'  => $token
                ));
            } catch (Exception $e) {
                $api_error = $e->getMessage();
            }
            $data = array(
                'customer_id' => $customer->id,
                'customer_name' => $name,
                'customer_phone' => $phone
            );
            $c_id =  $this->model->insertCustomer($data);
            if (empty($api_error) && $customer) {

                // Convert price to cents 
                $amount = ($amount * 100);

                // Charge a credit or a debit card 
                try {
                    $charge = \Stripe\Charge::create(array(
                        'customer' => $customer->id,
                        'amount'   => $amount,
                        'currency' => $currency,
                        'description' => $courseName,
                    ));
                } catch (Exception $e) {
                    $api_error = $e->getMessage();
                }

                if (empty($api_error) && $charge) {

                    // Retrieve charge details 
                    $chargeJson = $charge->jsonSerialize();

                    // Check whether the charge is successful 
                    if ($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1) {
                        // Transaction details  
                        $transactionID = $chargeJson['balance_transaction'];
                        $paidAmount = $chargeJson['amount'];
                        $paidAmount = ($paidAmount / 100);
                        $paidCurrency = $chargeJson['currency'];
                        $payment_status = $chargeJson['status'];

                        // Model part
                        $data = array(
                            'c_id' => $c_id,
                            'transact_id' => $transactionID,
                            'transact_amt' => $paidAmount,
                            'transact_status' => $payment_status
                        );
                        $payment_id = $this->model->insertTransaction($data);

                        // If the order is successful 
                        if ($payment_status == 'succeeded') {
                            $this->session->setFlashdata('formsuccess',  'Your Payment has been Successful!');
                        } else {
                            $this->session->setFlashdata('formerror', 'Your Payment has Failed.');
                        }
                    } else {
                        $this->session->setFlashdata('formerror', 'Transaction has been failed.');
                    }
                } else {
                    $this->session->setFlashdata('formerror', 'Charge creation failed.' . $api_error);
                }
            } else {
                $this->session->setFlashdata('formerror', 'Invalid card details.' . $api_error);
            }
            $this->db->transComplete();
        } else {
            $error = $this->validation->getErrors();
            $this->session->setFlashdata('error', $error);
            $this->session->setFlashdata('formerror', 'Make sure all fields are filled');
        }
        return redirect()->route('payments');
    }
}
