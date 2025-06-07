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
                'image' => 'tanukitokitune.jpg',
                'image_path' => 'tanukitokitune.jpg',
                'keyword' => 'どうぶつ',
                'creator' => 'なかがわえりこ　と　おおむらゆりこ',
                'publisher' => '福音館書店',
                'isbn' => '9784834000825',
            ],
            [
                'title' => 'のんたん　おやすみなさい',
                'caption' => 'のんたん',
                'image' => 'nontan.jpg',
                'image_path' => 'nontan.jpg',
                'keyword' => 'どうぶつ',
                'creator' => 'キヨノサチコ',
                'publisher' => '偕成社',
                'isbn' => '9784032170207',
            ],
            [
                'title' => 'ぴよちゃんのおともだち',
                'caption' => 'ピヨちゃんのおともだち',
                'image' => 'piyo.jpg',
                'image_path' => 'piyo.jpg',
                'keyword' => 'どうぶつ',
                'creator' => 'いりやまさとし',
                'publisher' => '学研プラス',
                'isbn' => '9784052052156',
            ],
            [
                'title' => 'ふみきりくん',
                'caption' => 'とある駅の踏切のお話',
                'image' => 'fumikirikun.jpg',
                'image_path' => 'fumikirikun.jpg',
                'keyword' => 'のりもの',
                'creator' => 'えのもとえつこ　と　かまたあゆみ',
                'publisher' => '福音館書店',
                'isbn' => '9784834084740',
            ],
            [
                'title' => 'タヌキとキツネ　ちびっこの冒険',
                'caption' => 'タヌキとキツネの小さなころのお話',
                'image' => 'tanukitokitune.jpg',
                'image_path' => 'tanukitokitune.jpg',
                'keyword' => 'どうぶつ',
                'creator' => 'アタモト',
                'publisher' => 'フロンティアワークス',
                'isbn' => '9784866574417',
            ],
        ]);
        
        
        
   }
}
