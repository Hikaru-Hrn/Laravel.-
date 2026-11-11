<?php

namespace App\Http\Resources;

use App\Models\Author;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'published_at' => $this->published_at?->toDateString(),
            'category' => $this->whenLoaded('category', fn () => [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ]),
            'authors' => $this->whenLoaded('authors', fn () => $this->authors->map(fn (Author $author) => [
                'id' => $author->id,
                'name' => $author->name,
            ])->values()),
            'reviews' => $this->whenLoaded('reviews', fn () => $this->reviews->map(fn (Review $review) => [
                'id' => $review->id,
                'reviewer_name' => $review->reviewer_name,
                'rating' => $review->rating,
                'body' => $review->body,
            ])->values()),
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
            'deleted_at' => $this->deleted_at?->toDateTimeString(),
        ];
    }
}
