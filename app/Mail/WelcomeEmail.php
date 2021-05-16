<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $bill;
    protected $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($bill,$name)
    {
        $this->bill = $bill;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('customers.emails.orders')
                    ->from('trandinhthienphp@gmail.com','FOWA SHOP!')
                    ->subject('Xác nhận đặt hàng thành công!')
                    ->with(['bill'=>$this->bill,'user'=>$this->name]);
    }
}