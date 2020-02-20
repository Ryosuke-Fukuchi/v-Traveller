<?php

use Illuminate\Database\Seeder;

class PrefecturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('prefectures')->insert([
          ['pre' => '北海道', 'pre_eng' => 'Hokkaido'],
          ['pre' => '青森', 'pre_eng' => 'Aomori'],
          ['pre' => '岩手', 'pre_eng' => 'Iwate'],
          ['pre' => '宮城', 'pre_eng' => 'Miyagi'],
          ['pre' => '秋田', 'pre_eng' => 'Akita'],
          ['pre' => '山形', 'pre_eng' => 'Yamagata'],
          ['pre' => '福島', 'pre_eng' => 'Fukushima'],
          ['pre' => '茨城', 'pre_eng' => 'Ibaraki'],
          ['pre' => '栃木', 'pre_eng' => 'Tochigi'],
          ['pre' => '群馬', 'pre_eng' => 'Gunma'],
          ['pre' => '埼玉', 'pre_eng' => 'Saitama'],
          ['pre' => '千葉', 'pre_eng' => 'Chiba'],
          ['pre' => '東京', 'pre_eng' => 'Tokyo'],
          ['pre' => '神奈川', 'pre_eng' => 'Kanagawa'],
          ['pre' => '新潟', 'pre_eng' => 'Niigata'],
          ['pre' => '富山', 'pre_eng' => 'Toyama'],
          ['pre' => '石川', 'pre_eng' => 'Ishikawa'],
          ['pre' => '福井', 'pre_eng' => 'Fukui'],
          ['pre' => '山梨', 'pre_eng' => 'Yamanashi'],
          ['pre' => '長野', 'pre_eng' => 'Nagano'],
          ['pre' => '岐阜', 'pre_eng' => 'Gifu'],
          ['pre' => '静岡', 'pre_eng' => 'Shizuoka'],
          ['pre' => '愛知', 'pre_eng' => 'Aichi'],
          ['pre' => '三重', 'pre_eng' => 'Mie'],
          ['pre' => '滋賀', 'pre_eng' => 'Shiga'],
          ['pre' => '京都', 'pre_eng' => 'Kyoto'],
          ['pre' => '大阪', 'pre_eng' => 'Osaka'],
          ['pre' => '兵庫', 'pre_eng' => 'Hyogo'],
          ['pre' => '奈良', 'pre_eng' => 'Nara'],
          ['pre' => '和歌山', 'pre_eng' => 'Wakayama'],
          ['pre' => '鳥取', 'pre_eng' => 'Tottori'],
          ['pre' => '島根', 'pre_eng' => 'Shimane'],
          ['pre' => '岡山', 'pre_eng' => 'Okayama'],
          ['pre' => '広島', 'pre_eng' => 'Hiroshima'],
          ['pre' => '山口', 'pre_eng' => 'Yamaguchi'],
          ['pre' => '徳島', 'pre_eng' => 'Tokushima'],
          ['pre' => '香川', 'pre_eng' => 'Kagawa'],
          ['pre' => '愛媛', 'pre_eng' => 'Ehime'],
          ['pre' => '高知', 'pre_eng' => 'Kochi'],
          ['pre' => '福岡', 'pre_eng' => 'Fukuoka'],
          ['pre' => '佐賀', 'pre_eng' => 'Saga'],
          ['pre' => '長崎', 'pre_eng' => 'Nagasaki'],
          ['pre' => '熊本', 'pre_eng' => 'Kumamoto'],
          ['pre' => '大分', 'pre_eng' => 'Oita'],
          ['pre' => '宮崎', 'pre_eng' => 'Miyazaki'],
          ['pre' => '鹿児島', 'pre_eng' => 'Kagoshima'],
          ['pre' => '沖縄', 'pre_eng' => 'Okinawa'],
      ]);
    }
}
