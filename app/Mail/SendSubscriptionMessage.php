<?php

namespace App\Mail;

use App\Models\Sku;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class SendSubscriptionMessage extends Mailable
{
    use Queueable, SerializesModels;

    protected $sku;
    protected $name;

    /**
     * Create a new message instance.
     *
     * @param  Sku  $sku
     * @param $name
     */
    public function __construct(Sku $sku,$name)
    {
        $this->sku = $sku;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.subscription',["product" => $this->sku,"name" => $this->name,"sku" => $this->sku]);
    }
}
