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

  /**
   * Create a new notification instance.
   * @param $name
   * @param $email
   * @param $message
   */
  public function __construct($name, $email, $message)
  {
    $this->name    = $name;
    $this->email   = $email;
    $this->message = $message;
  }

  /**
   * Get the notification's delivery channels.
   * @param  mixed $notifiable
   * @return array
   */
  public function via($notifiable)
  {
    return [ 'mail' ];
  }

  /**
   * Get the mail representation of the notification.
   * @param  mixed $notifiable
   * @return \Illuminate\Notifications\Messages\MailMessage
   */
  public function toMail($notifiable)
  {
      return ( new MailMessage )->line('Message Received from the website:')
                                ->line('Sender: ' . $this->name)
                                ->line('Email: ' . $this->email)
                                ->line('Message:')
                                ->line(strip_tags($this->message))
                                ->line('')
                                ->line('Thank you for using our application!');
  }

  /**
   * Get the array representation of the notification.
   * @param  mixed $notifiable
   * @return array
   */
  public function toArray($notifiable)
  {
    return [//
    ];
  }
}