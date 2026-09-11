<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * uuid — не секрет (виден в приложении, см. App\Models\DeviceToken), поэтому
 * exists:users,uuid тут ничего не палит — в отличие от email-полей в ForgotPasswordRequest,
 * где exists специально не используется, чтобы не давать перечислять зарегистрированные
 * email по ответу валидации.
 *
 * email — адрес, который клиент хочет привязать к своему uuid-аккаунту. Он ещё не
 * записан в users (это как раз то, что подтверждает код), поэтому unique:users,email
 * просто не даёт запросить код на email, уже занятый другим аккаунтом.
 */
class OneTimeCodeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'uuid' => ['required', 'uuid', 'exists:users,uuid'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        ];
    }
}
