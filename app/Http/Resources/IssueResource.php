<?php

namespace GitScrum\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IssueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'description' => $this->description,
            'effort' => $this->whenLoaded('configEffort', function () {
                return [
                    'id' => $this->configEffort->id,
                    'title' => $this->configEffort->title,
                ];
            }),
            'type' => $this->whenLoaded('type', function () {
                return [
                    'slug' => $this->type->slug,
                    'title' => $this->type->title,
                    'color' => $this->type->color,
                ];
            }),
            'status' => $this->whenLoaded('status', function () {
                return [
                    'slug' => $this->status->slug,
                    'title' => $this->status->title,
                    'is_closed' => (bool) $this->status->is_closed,
                ];
            }),
            'sprint' => $this->whenLoaded('sprint', function () {
                return $this->sprint ? [
                    'slug' => $this->sprint->slug,
                    'title' => $this->sprint->title,
                ] : null;
            }),
            'users' => $this->whenLoaded('users', function () {
                return $this->users->map(function ($user) {
                    return [
                        'username' => $user->username,
                        'avatar' => $user->avatar,
                    ];
                });
            }),
            'position' => $this->position,
            'closed_at' => $this->closed_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
