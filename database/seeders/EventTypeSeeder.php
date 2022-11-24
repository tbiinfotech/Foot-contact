<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EventType as Event;

class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $events = [ 
            [ 
              'title' => 'Match',
              'status' => 1,
              'level' => 1
            ],
            [ 
               'title' => 'Traning',
               'status' => 1, 
               'level' => 2
            ],
            [ 
               'title' => 'General Event',
               'status' => 1,
               'level' => 3
             ]
          ];
   
          foreach($events as $event)
          {
           Event::create([
               'title' => $event['title'],
               'status' => $event['status'],
                'level' => $event['level']
             ]);
           }
    }
}
