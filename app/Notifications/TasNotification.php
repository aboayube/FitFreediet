<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TasNotification extends Notification
{
    use Queueable;
protected $tag;
protected $type;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($tag,$type)
    {
        $this->tag=$tag;
        $this->type=$type;
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
        $msg='';
        if($this->type=='tag'){
$msg='تم انشاء تصنيف جديد';
        }else if($this->type=='categories'){
$msg="تم انشاء قسم جديد";
        }
        return [
            'type'=>'deparments',
            'msg'=>$msg,
            'message'=>$this->tag->name,
            'action'=>route('admin.tags.index'),
            'user-name'=>$this->tag->user->name,
            'image'=>'<i class="fas fa-tags fa-2x"></i>',
            'icon'=>'<i class="fas fa-user"></i>'
        ];
    }
}
