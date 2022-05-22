<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreated extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $order;

    /**
     * OrderCreated constructor.
     *
     * @param $name
     * @param  Order  $order
     */
    public function __construct($name, Order $order)
    {
        $this->name = $name;
        $this->order = $order;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $fullSum = $this->order->calculateOrderPrice();
        return $this->subject('Создан заказ №' . $this->order->id)->view('mail.order_created',['name' => $this->name,'order' => $this->order,'fullSum' => $fullSum]);
    }
}
