<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $vietnameseFullNames = [
            'Nguyễn Văn Nam',
            'Lê Quang Sáng',
            'Trần Thị Hương',
            'Phạm Minh Tuấn',
            'Đỗ Ngọc Thảo',
            'Vũ Quốc Anh',
            'Ngô Thị Hà',
            'Lý Văn Đức',
            'Bùi Thị Lan',
            'Hoàng Đức Thịnh',
            'Đinh Thị Mai',
            'Mai Văn Hải',
            'Phan Thị Thu Hương',
            'Trịnh Văn Tâm',
            'Đặng Ngọc Anh',
            'Võ Thị Huệ',
            'Hoàng Anh Tuấn',
            'Lê Thị Thanh Hà',
            'Nguyễn Đình Khoa',
        ];
        $array = [
            'nguyenvannam',
            'lequangsang',
            'tranthihuong',
            'phamminhtuan',
            'dongocthao',
            'vuquocanh',
            'ngthiha',
            'lyvanduc',
            'buithilan',
            'hoangducthinh',
            'dinhthimai',
            'maivanhai',
            'phanthithuhuong',
            'trinhvantam',
            'dangngocanh',
            'vothihue',
            'hoanganhtuan',
            'lethithanhha',
            'nguyendinhkhoa',
        ];

        foreach ($vietnameseFullNames  as $key => $value) {
            DB::table('users')->insert([
                'name' => $value,
                'email' => $array[$key] . '@gmail.com',
                'password' => Hash::make(12345678),
            ]);
        }
    }
}
