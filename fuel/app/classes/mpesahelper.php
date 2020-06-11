<?php

class Mpesahelper
{
    public $mpesa;

    public function __construct($slug)
    {
        $this->mpesa = new \Safaricom\Mpesa\Mpesa();
    }
    
    /*
     * Callback Routes M-Pesa APIs are asynchronous. When a valid M-Pesa API request is received by the API Gateway, it is sent to M-Pesa where it is added to a queue. 
     * M-Pesa then processes the requests in the queue and sends a response to the API Gateway which then forwards the response to the URL registered in the CallBackURL
     * or ResultURL request parameter. Whenever M-Pesa receives more requests than the queue can handle, M-Pesa responds by rejecting any more requests and the API Gateway 
     * sends a queue timeout response to the URL registered in the QueueTimeOutURL request parameter.
    */
    public static function get_post_data()
    {
        // Obtaining post data from callbacks This is used to get post data from callback in json format. The data can be decoded and stored in a database.
        $resultData = $mpesa->getDataFromCallback();

        // Finishing a transaction After obtaining the Post data from the callbacks, use this at the end of your callback routes to complete the transaction
        $endTransaction = $mpesa->finishTransaction();
        // If validation fails, pass false to finishTransaction()
        // $endTransaction = $mpesa->finishTransaction(false);

        return $resultData;
    }

    // This is used to Simulate transfer of funds between a customer and business.
    public static function c2b_payment_request()
    {
        $c2bTransaction = $mpesa->c2b(
                                    $ShortCode, 
                                    $CommandID, 
                                    $Amount, 
                                    $Msisdn, 
                                    $BillRefNumber
                                );
        return $c2bTransaction;
    }

    // This is used to transfer funds between two companies.
    public static function b2b_payment_request()
    {
        $b2bTransaction = $mpesa->b2b(
                                    $ShortCode, 
                                    $CommandID, 
                                    $Amount, 
                                    $Msisdn, 
                                    $BillRefNumber
                                );

        return $b2bTransaction;
    }

    // This is used to check the status of transaction.
    public static function transaction_status_request()
    {
        $trasactionStatus = $mpesa->transactionStatus(
                                                $Initiator, 
                                                $SecurityCredential, 
                                                $CommandID, 
                                                $PartyA, 
                                                $IdentifierType, 
                                                $ResultURL, 
                                                $QueueTimeOutURL, 
                                                $Remarks, 
                                                $TransactionID, 
                                                $Occasion
                                            );

        return $trasactionStatus;
    }

    // This is used to enquire the balance on an M-Pesa BuyGoods (Till Number)
    public static function account_balance_request()
    {
        $balanceInquiry = $mpesa->accountBalance(
                                                $Initiator, 
                                                $SecurityCredential, 
                                                $CommandID, 
                                                $PartyA, 
                                                $IdentifierType, 
                                                $QueueTimeOutURL, 
                                                $ResultURL,
                                                $Remarks, 
                                            );
        return $balanceInquiry;
    }

    // This creates transaction between an M-Pesa short code to a phone number registered on M-Pesa.
    public static function b2c_payment_request()
    {
        $b2cTransaction = $mpesa->b2c(
                                    $InitiatorName, 
                                    $SecurityCredential, 
                                    $CommandID, 
                                    $Amount, 
                                    $PartyA, 
                                    $PartyB, 
                                    $QueueTimeOutURL, 
                                    $ResultURL, 
                                    $Remarks, 
                                    $Occasion
                                );
        return $b2cTransaction;
    }

    // This is used to initiate online payment on behalf of a customer.
    public static function stk_push_simulation()
    {
        $stkPushSimulation = $mpesa->STKPushSimulation(
                                                    $BusinessShortCode, 
                                                    $LipaNaMpesaPasskey, 
                                                    $TransactionType, 
                                                    $Amount, 
                                                    $PartyA, 
                                                    $PartyB, 
                                                    $PhoneNumber, 
                                                    $CallBackURL, 
                                                    $AccountReference, 
                                                    $TransactionDesc, 
                                                    $Remarks
                                                );
        return $stkPushSimulation;
    }

    // This is used to check the status of a Lipa Na M-Pesa Online Payment.
    public static function stk_push_query()
    {
        $stkPushRequestStatus = $mpesa->STKPushQuery(
                                                $checkoutRequestID,
                                                $businessShortCode,
                                                $password,
                                                $timestamp
                                            );
        return $stkPushRequestStatus;
    }
}