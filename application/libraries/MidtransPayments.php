<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Payments
 */
class MidtransPayments
{
    // default status 1: Pending; 2: Success; 3: Canceled; 4: Rejected; 5: Expired;
    /**
     * cvtStatusToInt
     *
     * @param  mixed $status
     * @return void
     */
    public function cvtStatusToInt($status = 1)
    {
        if ($status == 'pending') {
            return 1;
        } elseif ($status == 'cancel' || $status == 'failure') {
            return 3;
        } elseif ($status == 'expire') {
            return 5;
        } elseif ($status == 'deny') {
            return 4;
        } elseif ($status == 'settlement' || $status == 'capture' || $status == 'success') {
            return 2;
        } else {
            return 1;
        }
    }

    // default status 1: Pending; 2: Success; 3: Canceled; 4: Rejected; 5: Expired;
    /**
     * cvtStatusToString
     *
     * @param  mixed $status
     * @return void
     */
    public function cvtStatusToString($status = 1)
    {
        if ($status == 1) {
            return 'pending';
        } elseif ($status == 2) {
            return 'success';
        } elseif ($status == 3) {
            return 'cancel';
        } elseif ($status == 4) {
            return 'deny';
        } elseif ($status == 5) {
            return 'expire';
        } else {
            return 'deny';
        }
    }

    /**
     * use this to build based array response for table payments
     *
     * @param  mixed $result from midtrans response after finish
     * @return void
     */
    public function cvtPaymentMethodMidtrans($result = null)
    {
        // based data
        $based = [
            'transaction_id' => $result->transaction_id, #> REQUIRED
            'order_id' => $result->order_id, #> REQUIRED
            'payment_type' => $result->payment_type, #> REQUIRED
            'amount' => $result->gross_amount, #> REQUIRED
            'status' => $this->cvtStatusToInt($result->transaction_status), #> REQUIRED
            'pdf_url' => isset($result->pdf_url) ? $result->pdf_url : null,
            'transaction_time' => $result->transaction_time,
            'status_code' => $result->status_code
        ];

        if ($result->payment_type == 'bank_transfer') {
            if (isset($result->permata_va_number)) {
                $data = [
                    'payment_setting' => 9, #payment setting see tb_payment_setting #> REQUIRED
                    'va_number' => $result->permata_va_number, #> REQUIRED
                ];
            } elseif ($result->va_numbers[0]->bank == 'bni') {
                $data = [
                    'payment_setting' => 19, #payment setting see tb_payment_setting #> REQUIRED
                    'va_number' => $result->va_numbers[0]->va_number, #> REQUIRED
                ];
            } elseif ($result->va_numbers[0]->bank == 'bri') {
                $data = [
                    'payment_setting' => 11, #payment setting see tb_payment_setting #> REQUIRED
                    'va_number' => $result->va_numbers[0]->va_number, #> REQUIRED
                ];
            } elseif ($result->va_numbers[0]->bank == 'bca') {
                $data = [
                    'payment_setting' => 12, #payment setting see tb_payment_setting #> REQUIRED
                    'va_number' => $result->va_numbers[0]->va_number, #> REQUIRED
                ];
            }
        } elseif ($result->payment_type == 'echannel') { #mandiri
            $data = [
                'payment_setting' => 13, #payment setting see tb_payment_setting #> REQUIRED
                'va_number' => $result->bill_key, #> REQUIRED (mandiri va using bill key)
                'others' => json_encode([
                        'bill_key' => $result->bill_key,
                        'biller_code' => $result->biller_code
                    ])
            ];
        } elseif ($result->payment_type == 'gopay') {
            $data = [
                'payment_setting' => 15, #payment setting see tb_payment_setting #> REQUIRED
            ];
        } elseif ($result->payment_type == 'qris') { #shopeepay
            $data = [
                'payment_setting' => 16, #payment setting see tb_payment_setting #> REQUIRED
            ];
        } elseif ($result->payment_type == 'credit_card') {
            $data = [
                'payment_setting' => 17, #payment setting see tb_payment_setting #> REQUIRED
                'others' => json_encode([
                        'bank' => $result->bank,
                        'masked_card,' => $result->masked_card,
                        'card_type,' => $result->card_type
                    ])
            ];
        } elseif ($result->payment_type == 'cstore') {
            $data = [
                'payment_setting' => 18, #payment setting see tb_payment_setting #> REQUIRED
                'va_number' => $result->payment_code, #> REQUIRED (cstore using payment_code as va)
            ];
        }

        return array_merge($based, $data);
    }
}
