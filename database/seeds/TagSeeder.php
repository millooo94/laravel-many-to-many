<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Rock', 'Pop', 'Classica', 'Heavy Metal', 'Jazz', 'House', 'Dance', 'Electronic', 'Acustic', 'Cover',
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'slug'  => Tag::getSlug($tag),
                'name'  => $tag,
            ]);
    }
}
