<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $danhSach = ['Danh mục','Menu','Slider','Sản phẩm','Setting','Nhân viên','Vai trò'];
        $keyCode = ['category','menu','slider','product','setting','staff','role'];
        $list = ['list','add','edit','delete'];
        $listVN = ['Danh sách','Thêm','Sửa','Xóa'];
        foreach ($danhSach as $key1 => $value) {
            $dataRoot = [
                'name' => $value,
                'display_name' => $value,
                'parent_id' => 0,
                'key_code' => ''
            ];
            $id = DB::table('permissions')->insertGetId($dataRoot);
                foreach ($list as $key => $value1) {
                    $dataChild = [
                        'name' => $listVN[$key]." ".$value,
                        'display_name' => $listVN[$key]." ".$value,
                        'parent_id' => $id,
                        'key_code' => $value1."_".$keyCode[$key1]
                    ];
                    DB::table('permissions')->insert($dataChild);
                }

        }
    }
}