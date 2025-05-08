<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('books')->insert([
            [
                'title' => 'ぐりとぐら',
                'caption' => 'ぐりとぐらの説明文',
                'image' => 'guriandgura.jpg',
                'keyword' => 'どうぶつ',
                'creator' => 'なかがわえりこ　と　おおむらゆりこ',
                'publisher' => '福音館書店',
            ],
            [
                'title' => 'のんたん　おやすみなさい',
                'caption' => 'のんたん',
                'image' => 'nontan.jpg',
                'keyword' => 'どうぶつ',
                'creator' => 'キヨノサチコ',
                'publisher' => '偕成社',
            ],
            [
                'title' => 'ぴよちゃんのおともだち',
                'caption' => 'ピヨちゃんのおともだち',
                'image' => 'piyo.jpg',
                'keyword' => 'どうぶつ',
                'creator' => 'いりやまさとし',
                'publisher' => '学研プラス',
            ],
        ]);

   }
}
