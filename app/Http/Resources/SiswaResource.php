<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiswaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'kelas_id'  => $this->kelas_id,
            'NISN'      => $this->NISN,
            'email'     => $this->email,
            'name'      => $this->name,
            'role_id'   => $this->role_id
        ];
    }
}
