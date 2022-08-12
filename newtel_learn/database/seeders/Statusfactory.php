<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class Statusfactory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = ['Chưa làm', 'Đang làm', 'Xong', 'Chờ duyệt', 'Duyệt'];
        $statuses1 = ['Đúng hạn', 'Trước hạn', 'Quá hạn'];
        foreach($statuses as $status){
            Status::create([
                'name' => $status,
                'use' => 1
            ]);
        }
        foreach($statuses1 as $status) {
            Status::create([
                'name' => $status,
                'use' => 2
            ]);
        }
    }   
}
