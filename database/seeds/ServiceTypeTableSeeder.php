<?php

use Illuminate\Database\Seeder;

class ServiceTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Each Room',
            'Room Service',
            'Laundry',
            'Additional',
        ];

        foreach ($data as $item){
            $check =  \App\Models\ServicesType::query()->where('name','=',$item)->first();
            if(!$check){
                $ServicesType =  new \App\Models\ServicesType();
                $ServicesType->name = $item;
                $ServicesType->save();
            }
        }
    }
}
