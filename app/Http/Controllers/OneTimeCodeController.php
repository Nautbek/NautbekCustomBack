<?php

namespace App\Http\Controllers;

use App\Http\Requests\OneTimeCodeRequest;
use App\Models\OneTimeCode;
use App\Models\User;
use App\Notifications\EmailConfirmationCodeNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;

/**
 *
 * Throttle 5,1 висит на роуте (routes/api.php) — этот эндпоинт шлёт письма и не должен
 * позволять засыпать чужой почтовый ящик кодами.
 */
class OneTimeCodeController extends Controller
{
    public function __invoke(OneTimeCodeRequest $request): JsonResponse
    {
        $uuid = $request->string('uuid')->toString();
        $email = $request->string('email')->toString();

        $user = User::query()->where('uuid', $uuid)->first();

        if ($user === null) {
            return response()->json(['error' => 'user_not_found'], 404);
        }

        OneTimeCode::query()->where('user_id', $user->id)->delete();

        $code = (string) random_int(1000, 9999);

        OneTimeCode::query()->create([
            'user_id' => $user->id,
            'code' => $code,
        ]);

        // На email, который клиент хочет привязать, а не через $user->notify() — у юзера
        // сейчас в базе ещё placeholder ({uuid}@temp.local), не тот адрес, что проверяем.
        Notification::route('mail', $email)->notify(new EmailConfirmationCodeNotification($code));

        return response()->json([
            'message' => 'Код отправлен на почту.',
        ]);
    }
}
