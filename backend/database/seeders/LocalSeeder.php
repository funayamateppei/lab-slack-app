<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Channel;
use App\Models\Message;
use App\Models\Attachment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // if (\App::environment('local')) {
        //    $this->call(LocalSeeder::class); // Local開発用
        // } elseif (\App::environment('staging')) {
        //    $this->call(StagingSeeder::class); // Staging確認用
        // } elseif (\App::environment('production')) {
        //    $this->call(ProductionSeeder::class); // Production用の初期データ
        // }

        // １件だけダミーデータを作成
        // Channel::create([
        //         'uuid' =>  \Str::uuid(),
        //         'name' => 'Testチャンネル',
        //     ]);


        // ユーザーのダミーデータ作成
        User::factory()
            ->create([
                'email' => 'test1@example.com',
                'nickname' => 'テストユーザー1'
            ]);

        User::factory()
            ->create([
                'email' => 'test2@example.com',
                'nickname' => 'テストユーザー2'
            ]);
        
        User::factory()
            ->count(8)
            ->create();

         // 「Factoryの定義に合わせて、１０件のデータをつくってくれー」って感じの指定です
        $channels = Channel::factory()->count(10)->create();

        // メッセージのダミーデータ作成
        foreach ($channels as $channel) {
            Message::factory()
                ->count(10)
                ->create([
                    'channel_id' => $channel->id
                ]);
        }

        // アタッチメントのダミーデータ作成
        Attachment::factory()
            ->count(10)
            ->create();
    }
}
