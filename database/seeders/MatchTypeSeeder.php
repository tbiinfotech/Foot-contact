<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MatchType as Matchtype;

class MatchTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $matchs = [ 
            [ 
              'title' => 'League',
              'status' => 1,
            ],
            [ 
               'title' => 'Cup Game',
               'status' => 1, 
            ],
            [ 
               'title' => 'Friendly',
               'status' => 1,
             ]
          ];
   
          foreach($matchs as $match)
          {
            Matchtype::create([
               'title' => $match['title'],
               'status' => $match['status'],
             ]);
           }
    }
}
