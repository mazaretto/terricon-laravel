<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class FielderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fielders')->insert([
            ['field_name' => 'phone', 'field_value' => '+7 999 999 99 99'],
            ['field_name' => 'email', 'field_value' => '0@hpace.ru'],
            ['field_name' => 'slogan', 'field_value' => 'Закажите разработку у меня и получите скидку 15% на все услуги до Нового года. *Только для новых клиентов.'],
            ['field_name' => 'about_me', 'field_value' => 'Меня зовут Андрей, я веб-разработчик с опытом 7 лет, знаю следующие языки программирования: PHP, JavaScript, Golang'],
            ['field_name' => 'deviz', 'field_value' => 'Делай хорошо, плохо не делай']
        ]);
    }
}
