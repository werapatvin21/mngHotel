<?php

use Illuminate\Database\Seeder;

class AgentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agents = [
            'Walk-In',
            'Agoda',
            'Airbnb',
            'Booking',
            'Expedia',
            'Trip.com',
            'Traveloka',
            'Travizgo',
            'Trivago',
            'Other'
        ];

        foreach ($agents as $agent){
            $query = \App\Models\Agent::query()
                ->where('name', '=',$agent)
                ->first();
            if ($query == null) {
                $Agent = new \App\Models\Agent();
                $Agent->name = $agent;
                $Agent->save();
            }
        }



    }
}
