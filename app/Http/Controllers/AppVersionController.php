<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppVersionCheckRequest;
use App\Http\Resources\AppVersionResource;
use App\Models\AppVersion;
use Illuminate\Support\Facades\Cache;

class AppVersionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AppVersionCheckRequest $request) : AppVersionResource
    {
        $app = $request->string('app')->value();

        $version = Cache::remember('app_version_' . $app, 3600, function () use ($app) {
            return AppVersion::query()->where('app', $app)->firstOrFail();
        });

        return new AppVersionResource($version);
    }
}
