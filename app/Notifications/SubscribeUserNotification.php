<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscribeUserNotification extends Notification
{
    use Queueable;

  protected $subscribe;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($subscribe)
    {
        $this->subscribe=$subscribe;
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
           
            'type'=>'subscribeuser',
            'msg'=>' جديد تم تسجيل اشتراك',
            'message'=>'تم اشتراك مستخدم '.$this->subscribe->user->name.'بخدمة '.$this->subscribe->service->name,
            'action'=>route('admin.users.index'),
            'image'=>'<i class="fas fa-tags fa-2x"></i>',
            'icon'=>'<i class="fas fa-user"></i>'
       
        ];
    }
}
