<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class SendSubscriptionMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $product;
    protected $name;

    /**
     * Create a new message instance.
     *
     * @param  Product  $product
     * @param $name
     */
    public function __construct(Product $product,$name)
    {
        $this->product = $product;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.subscription',["product" => $this->product,"name" => $this->name]);
    }
}
