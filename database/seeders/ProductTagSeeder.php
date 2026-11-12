<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Tags;

class ProductTagSeeder extends Seeder
{
    public function run(): void
    {
        $assignments = [
            'Laravel Course' => ['Laravel', 'PHP'],
            'PHP Handbook' => ['PHP'],
            'JavaScript Guide' => ['JavaScript', 'HTML', 'CSS'],
            'React Course' => ['React', 'JavaScript'],
        ];

        foreach ($assignments as $productName => $tagNames) {
            $product = Product::where('name', $productName)->first();

            if (!$product) {
                continue;
            }

            $tagIds = Tags::whereIn('tag_name', $tagNames)
                ->pluck('id')
                ->toArray();

            $product->tags()->syncWithoutDetaching($tagIds);
        }
    }
}