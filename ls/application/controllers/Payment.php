<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use GuzzleHttp\Client;

require_once(APPPATH . 'third_party/stripe/init.php');

class Payment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("user_model");
        if (!$this->user->loggedin) {
            redirect(site_url("login"));
        }
    }

    function index() {
        return false;
        // Assigns the highlight to the sidebar link
        $this->template->loadData("activeLink", array("payment" => array("general" => 1)));

        //$this->template->set_error_view("error/login_error.php");
        //$this->template->set_layout("layout/login_layout.php");

        $this->template->loadContent("support/index.php", array());
    }

    function cancel($hash = false) {
        $this->template->set_error_view("error/login_error.php");
        $config = $this->config->item("cookieprefix");
        $this->load->helper("cookie");
        if ($hash != $this->security->get_csrf_hash()) {
            $this->template->error(lang("error_6"));
        }


        //Gt user info
        $user = $this->user->info;

        //Update user details
        $this->db->where('ID', $user->ID);
        $this->db->update('users', array('user_role' => 6, 'active' => 0));

        /* delete_cookie($config . "un");
          delete_cookie($config . "tkn");
          delete_cookie($config . "provider");
          delete_cookie($config . "oauthid");
          delete_cookie($config . "oauthtoken");
          delete_cookie($config . "oauthsecret");
          $this->session->sess_destroy(); */
        redirect(base_url());
    }

    function tran_history($hash) {
        // Assigns the highlight to the sidebar link
        $this->template->loadData("activeLink", array("payment" => array("tran_history" => 1)));

        $this->template->set_error_view("error/login_error.php");
        $config = $this->config->item("cookieprefix");
        $this->load->helper("cookie");
        if ($hash != $this->security->get_csrf_hash()) {
            $this->template->error(lang("error_6"));
        }

        //Get user info fron user table
        $user = $this->user->info;

        $stripe_url = 'https://api.stripe.com/v1';
        $token = 'sk_test_aMyil0B0kH52lBo66U7iy7p3';

        $client = new Client();
        try {
            $response = $client->request('GET', "$stripe_url/charges", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ],
                'query' => [
                    'customer' => $user->customer_ID
                ],
                'verify' => false
            ]);
            $response = json_decode($response->getBody(), TRUE);
        } catch (Exception $e) {
            log_message('ERROR', $e->getMessage());
            echo $e->getMessage();
            exit();
        }

        $payment_his = $response['data'];

        return $this->template->loadContent("payment/history.php", array('payment_his' => $payment_his));
    }

    function history($hash) {
        // Assigns the highlight to the sidebar link
        $this->template->loadData("activeLink", array("payment" => array("history" => 1)));

        $this->template->set_error_view("error/login_error.php");
        $config = $this->config->item("cookieprefix");
        $this->load->helper("cookie");
        if ($hash != $this->security->get_csrf_hash()) {
            $this->template->error(lang("error_6"));
    }


        //Get user info fron user table
        $user = $this->user->info;
        //print_r($user); exit();
        
         return $this->template->loadContent("payment/payment-history.php", array('user' => $user));
    }

    function update($hash) {
        // Assigns the highlight to the sidebar link
        $this->template->loadData("activeLink", array("payment" => array("update" => 1)));

        $this->template->set_error_view("error/login_error.php");
        $config = $this->config->item("cookieprefix");
        $this->load->helper("cookie");
        if ($hash != $this->security->get_csrf_hash()) {
            $this->template->error(lang("error_6"));
        }


        //Get user info fron user table
        $user = $this->user->info;
        
        
        

        if (isset($_POST) && isset($_POST['stripeToken'])) {
            if (!isset($_SESSION['CARD_UPDATED_' . $user->customer_ID])) {
                \Stripe\Stripe::setApiKey("sk_test_aMyil0B0kH52lBo66U7iy7p3");

                $success = '';
                $error = '';
                try {
                    $cu = \Stripe\Customer::retrieve($user->customer_ID); // stored in your application
                    $cu->source = $_POST['stripeToken']; // obtained with Checkout
                    $cu->save();

                    $success = "Your card details have been updated!";
                } catch (\Stripe\Error\Card $e) {

                    // Use the variable $error to save any errors
                    // To be displayed to the customer later in the page
                    $body = $e->getJsonBody();
                    $err = $body['error'];
                    $error = $err['message'];
                }


                $parmas = array();
                $parmas['success'] = $success;
                $parmas['error'] = $error;
                $_SESSION['CARD_UPDATED_' . $user->customer_ID] = $parmas;
            }

            $parmas = $_SESSION['CARD_UPDATED_' . $user->customer_ID];

            return $this->template->loadContent("payment/payment-updated.php", array('parmas' => $parmas));
        } else {

            if (isset($_SESSION['CARD_UPDATED_' . $user->customer_ID])) {
                unset($_SESSION['CARD_UPDATED_' . $user->customer_ID]);
            }
            return $this->template->loadContent("payment/update.php", array());
        }
    }

    function ccauth($hash) {
        // Assigns the highlight to the sidebar link
        $this->template->loadData("activeLink", array("payment" => array("ccauth" => 1)));


        $this->template->set_error_view("error/login_error.php");
        $config = $this->config->item("cookieprefix");
        $this->load->helper("cookie");
        if ($hash != $this->security->get_csrf_hash()) {
            $this->template->error(lang("error_6"));
        }

        //Get user info fron user table
        $user = $this->user->info;

        $stripe_url = '';
        $token = 'sk_test_aMyil0B0kH52lBo66U7iy7p3';

        $client = new Client();
        try {
            $response = $client->request('POST', "https://api.stripe.com/v1/charges", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ],
                'form_params' => [
                    'capture' => 'false',
                    'customer' => $user->customer_ID,
                    'currency' => 'USD',
                    'amount' => '50',
                ],
                'verify' => false
            ]);
            $response = json_decode($response->getBody(), TRUE);
        } catch (Exception $e) {
            $response = $e->getMessage();
        }

        if ($response && $response['status'] && $response['status'] !== 'succeeded') {
            //Update user details
            $this->db->where('ID', $user->ID);
            $this->db->update('users', array('user_role' => 6, 'active' => 0));

            return $this->template->loadContent("payment/error.php", array());
        }

        if ($response && $response['status'] && $response['status'] === 'succeeded') {
            $cc_auth = $response['outcome'];
            $this->template->loadContent("payment/index.php", array('cc_auth' => $cc_auth));
        }
    }

}

?>