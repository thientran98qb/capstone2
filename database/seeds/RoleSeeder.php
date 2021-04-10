<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
             'name' => 'admin',
             'display_name' => 'Quản trị hệ thống'
            ],
            [
             'name' => 'guest',
             'display_name' => 'Khách hàng'
            ],
            [
             'name' => 'developer',
             'display_name' => 'Phát triển hệ thống'
            ],
            [
             'name' => 'content',
             'display_name' => 'Chỉnh sửa nội dung'
            ],
         ];
         DB::table('roles')->insert($data);
    }
}