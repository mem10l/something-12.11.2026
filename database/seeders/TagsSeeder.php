<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tags;

class TagsSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'PHP',
            'Laravel',
            'JavaScript',
            'HTML',
            'CSS',
            'React',
            'Vue',
            'MySQL',
        ];

        foreach ($tags as $tag) {
            Tags::firstOrCreate([
                'tag_name' => $tag
            ]);
        }
    }
}