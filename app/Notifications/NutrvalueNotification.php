<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NutrvalueNotification extends Notification
{
    use Queueable;
protected $nutrvalue;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($nutrvalue)
    {
        $this->nutrvalue=$nutrvalue;
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
            //
            'type'=>'nutrvalue',
            'msg'=>'تم اضافة وجبة جديدة الي حاسبة الوجبات الغذائية',
            'message'=>$this->nutrvalue->name,
            'action'=>route('admin.nutrs.index'),
            'user-name'=>$this->nutrvalue->name,
            'image'=>'<i class="fas fa-tags fa-2x"></i>',
            'icon'=>'<i class="fas fa-user"></i>'
        ];
    }
}
