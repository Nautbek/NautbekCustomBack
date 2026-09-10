<?php

namespace App\Http\Resources;

use App\Models\AppVersion;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin AppVersion */
class AppVersionResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'version_code' => $this->version_code,
            'version_name' => $this->version_name,
        ];
    }
}
