<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\invoices ;
use Illuminate\Support\Facades\Auth;

class AddInvoice extends Notification
{
    use Queueable;
    private $invoice_id;
    private $invoice ;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($invoice_id)
    {
        $this->invoice_id = $invoice_id;
        $invoice=invoices::find($invoice_id);
        $this->$invoice=$invoice ;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)

    {

        $url = 'http://127.0.0.1:8000/InvoicesDetails/'.$this->invoice_id;

        return (new MailMessage)
                    ->subject('اضافة فاتورة جديدة')
                    ->line('اضافة فاتورة جديدة')
                    ->action('عرض الفاتورة', $url)
                    ->line(' شكرا لاستخدامك نظام ادارة الفواتير الخاص بنا');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
    public function toDatabase($notifiable){

            return [

                'id'=> $this->invoice_id,
                'title'=>'تم اضافة فاتورة جديد بواسطة :',
                'user'=> Auth::user()->name,
                'email'=>Auth::user()->email,
            ];

    }
}
