<?php

namespace App\Services;

use App\Models\Entity;
use App\Models\Category;
use Illuminate\Support\Facades\Http;

class EntityService
{
    public function fetchAndStoreEntities(): void
    {
        $response = Http::get('http://web.archive.org/web/20240403172734/https://api.publicapis.org/entries');
        $entries = $response->json()['entries'];

        foreach ($entries as $entry) {
            $category = Category::where('category', $entry['Category'])->first();

            if ($category && in_array($category->category, ['Animals', 'Security'])) {
                Entity::create([
                    'api' => $entry['API'],
                    'description' => $entry['Description'],
                    'link' => $entry['Link'],
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}
