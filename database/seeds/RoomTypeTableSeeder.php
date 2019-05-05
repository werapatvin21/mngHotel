<?php

use Illuminate\Database\Seeder;

class RoomTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Standard Room',
            'Deluxe Room',
            'Joint Room',
            'Suite',
        ];

        foreach ($data as $item){
            $check =  \App\Models\RoomType::query()->where('name','=',$item)->first();
            if(!$check){
                $roomType =  new \App\Models\RoomType();
                $roomType->name = $item;
                $roomType->save();
            }
        }


    }
}
