<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactReason;

class ContactReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reasons = [
            [
                'title' => 'Reason 1',
                'description' => 'Lorem ipsum, in graphical and textual context, refers to filler text that is placed in a document or visual presentation. ',
            ],
            [
                'title' => 'Reason 2',
                'description' => 'Lorem ipsum, in graphical and textual context, refers to filler text that is placed in a document or visual presentation. ',
            ],
            [
                'title' => 'Reason 3',
                'description' => 'Lorem ipsum, in graphical and textual context, refers to filler text that is placed in a document or visual presentation. ',
            ],
            [
                'title' => 'Reason 4',
                'description' => 'Lorem ipsum, in graphical and textual context, refers to filler text that is placed in a document or visual presentation. ',
            ],

        ];

        foreach ($reasons as $reason) {
            ContactReason::create([
                'title' => $reason['title'],
                'description' => $reason['description']
            ]);
        }
    }
}
