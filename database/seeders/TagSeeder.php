<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Album;

class TagSeeder extends Seeder
{
    public function run()
    {
        $names = ['technology','education','music','news','comedy','business','science','history','sports','culture'];
        $tags = [];
        foreach ($names as $n) {
            $tags[] = Tag::firstOrCreate(['name' => $n]);
        }

        $albums = Album::all();
        if ($albums->count()) {
            foreach ($albums as $album) {
                // attach 1-3 random tags
                $pick = collect($tags)->random(rand(1,3))->pluck('id')->toArray();
                $album->Tags()->syncWithoutDetaching($pick);
            }
        }
    }
}
