<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailOrder;
use Exception;

class SendMailController extends Controller
{
    public function sendMailOrder($orderCode, $fullname, $email, $phone, $address, $listCartBuy, $totalAmount,$status, $discountAmount = 0)
    {
        try {
            Mail::to($email)->send(new SendMailOrder($orderCode, $fullname, $email,$phone, $address, $listCartBuy, $totalAmount,$status,$discountAmount));
            return "Mail sent successfully.";
        } catch (Exception $e) {
            return "Failed to send mail: " . $e->getMessage();
        }
    }
}
