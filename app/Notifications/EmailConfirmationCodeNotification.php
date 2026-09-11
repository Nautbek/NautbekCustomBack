<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Отправляется OneTimeCodeController — код для подтверждения email, который клиент хочет
 * привязать к своему анонимному uuid-аккаунту (см. TODO в routes/api.php про роут, который
 * эту привязку завершает: сверяет код и записывает email в users). Шлётся через
 * Notification::route('mail', $email) на сам подтверждаемый адрес, а не через
 * $user->notify() — у юзера на этот момент в базе ещё placeholder-email, не тот, что
 * проверяем (см. User::hasEmailLogin).
 *
 * Без ShouldQueue — как и ResetPasswordCodeNotification: код, пришедший с задержкой,
 * бесполезен, а letter точно ждут прямо сейчас на экране ввода кода.
 */
class EmailConfirmationCodeNotification extends Notification
{
    public function __construct(private readonly string $code)
    {
    }

    /**
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Код подтверждения email')
            ->greeting('Подтверждение email')
            ->line('Код для подтверждения: '.$this->code)
            ->line('Никому не сообщайте этот код.');
    }
}
