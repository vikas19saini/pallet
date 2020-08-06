<?php

namespace App\Mail;

use App\Events\EventSendMail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class SendMail extends Mailable {

    use Queueable,
        SerializesModels;

    public $user;
    public $data;
    public $type;

    /**
     * Create a new message instance.
     * @param EventSendMail $eventSendMail
     * @internal param User $user to mail is being sent
     * @internal param array $data contains type and other fields
     */
    public function __construct(EventSendMail $eventSendMail) {
        $this->user = $eventSendMail->user;
        $this->data = $eventSendMail->data;
        $this->type = $eventSendMail->type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        if ($this->type === "register.send") {
            $this->data['name'] = $this->user->name;
            return $this->to($this->user->email)
                            ->with($this->data)
                            ->from('noreply@thepalettestore.in', 'Thepalettestore')
                            ->subject('Thepalettestore Account verification')
                            ->view('emails.verify-registration');
        }

        if ($this->type === "order.completed") {
            return $this->to($this->user->email)
                            ->with($this->data)
                            ->from('noreply@thepalettestore.in', 'Thepalettestore')
                            ->subject('Thepalettestore Order placed')
                            ->view('emails.product-order');
        }


        if ($this->type === "password.reset.request") {
            $this->data['name'] = $this->user->name;
            return $this->to($this->user->email)
                            ->with($this->data)
                            ->from('noreply@thepalettestore.in', 'Thepalettestore')
                            ->subject('Thepalettestore password reset')
                            ->view('emails.password-reset-request');
        }

        if ($this->type === 'product.enquiry') {
            $this->data['name'] = $this->user->name;
            return $this->to($this->user->email)
                            ->with(['data' => $this->data])
                            ->from('noreply@thepalettestore.in', 'Thepalettestore')
                            ->subject('Thepalettestore product enquiry')
                            ->view('emails.product_enquiry');
        }
        if ($this->type === 'product.enquiry.admin') {
            return $this->to('raghav@hpsingh.com')
                            ->with(['data' => $this->data])
                            ->from('noreply@thepalettestore.in', 'Thepalettestore')
                            ->subject('Thepalettestore product enquiry')
                            ->view('emails.product_enquiry_admin');
        }
    }

}
