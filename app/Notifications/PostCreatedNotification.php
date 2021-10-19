<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostCreatedNotification extends Notification
{
    use Queueable;


    protected $post;
    protected $type;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post,$type)
    {
        $this->post=$post;
        $this->type=$type;
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
        ->subject('New  Post')
         ->greeting("FitFree يرحب بكم")
                    ->line('تم اضافة مقال جديد')
                    ->action('رابط المقال', url('/'))
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
        if($this->type=='post'){
$msg="تم انشاء مقال جديد";
        }else if($this->type=='wasfa'){
$msg='تم انشاء وصفة جديدة';
        }
        return [
            'type'=>"postsCreated",
            'msg'=>$msg,
           'message'=>$this->post->title,
           'action'=>route('admin.posts.index'),
           'image'=>$this->post->image,
           'user-name'=>$this->post->user->name,
           'icon'=>'<i class="fas fa-file-invoice"></i>'
        ];
    }
}
