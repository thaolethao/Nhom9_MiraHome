<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class SendMailOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $orderCode;
    public $fullname;
    public $email;
    public $phone;
    public $address;
    public $listCartBuy;
    public $totalAmount;       // final_amount (sau khi trừ voucher)
    public $discountAmount;    // số tiền được giảm
    public $status;

    /**
     * Create a new message instance.
     */
    public function __construct($orderCode, $fullname, $email, $phone, $address, $listCartBuy, $totalAmount, $status, $discountAmount = 0)
    {
        $this->orderCode      = $orderCode;
        $this->fullname       = $fullname;
        $this->email          = $email;
        $this->phone          = $phone;
        $this->address        = $address;
        $this->listCartBuy    = $listCartBuy;
        $this->totalAmount    = $totalAmount;
        $this->discountAmount = $discountAmount;
        $this->status         = $status;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('yen55646@gmail.com', 'MiraHome'),
            subject: "Xác nhận đơn hàng",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.sendMail',
            with: [
                'orderCode'      => $this->orderCode,
                'fullname'       => $this->fullname,
                'email'          => $this->email,
                'phone'          => $this->phone,
                'address'        => $this->address,
                'listCartBuy'    => $this->listCartBuy,
                'totalAmount'    => $this->totalAmount,       // final_amount
                'discountAmount' => $this->discountAmount,     // mới
                'status'         => $this->status,
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
