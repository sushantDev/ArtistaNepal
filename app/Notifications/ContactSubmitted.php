<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ContactSubmitted extends Notification
{
    use Queueable;
    private $name;
    private $email;
    private $message;
    private $price;
    private $venue;
    private $date;

    /**
     * Create a new notification instance.
     *
     * @param $name
     * @param $email
     * @param $message
     */
    public function __construct($name, $email, $message, $price, $venue, $date)
    {
        $this->name    = $name;
        $this->email   = $email;
        $this->message = $message;
        $this->price   = $price;
        $this->venue   = $venue;
        $this->date    = $date;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [ 'mail' ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->line('Message Received from the website:')
                                ->line('Sender: ' . $this->name)
                                ->line('Email: ' . $this->email)
                                ->line('Price: ' . $this->price)
                                ->line('venue: ' . $this->venue)
                                ->line('date: ' . $this->date)
                                ->line('Message:')
                                ->line(strip_tags($this->message))
                                ->line('')
                                ->line('Please reply to our mail if you accept all the price date and venue. Feel free to contact us if you want to negotiate the price for the event.')
                                ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [//
        ];
    }
}