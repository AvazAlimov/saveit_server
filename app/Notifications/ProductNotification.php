<?php

namespace App\Notifications;

use App\Category;
use App\Market;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class ProductNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     * @return array
     * @internal param mixed $notifiable
     */

    public function via()
    {
        return [TelegramChannel::class];
    }

    public function toTelegram($product)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $market = Market::find($product->market);

        /** @noinspection PhpUndefinedMethodInspection */
        return TelegramMessage::create()
            ->to(173201747)
            ->content(
                "*Купить продукт со скидкой*" .
                "\n*Категория:* " . Category::find($product->category)->name .
                "\n*Название продукта:* " . $product->name .
                "\n*Магазин:* " . $market->name .
                "\n*Адрес:* " . $market->address .
                "\n*Начальная цена:* " . $product->originalprice .
                "сум\n*Скидка:* " . $product->discont .
                "%\n*Конечная цена:* " . $product->newprice .
                "сум\n*Ед. изм:* " . $product->unit
            );
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
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
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
