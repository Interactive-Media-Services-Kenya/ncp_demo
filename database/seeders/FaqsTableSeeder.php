<?php

namespace Database\Seeders;

use App\Models\FAQs;
use Illuminate\Database\Seeder;

class FaqsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faqs = [
            [
                'id'    => 1,
                'question' => 'How do I Contact Customer care?',
                'answer' => 'Please Contact 0759493421 or Compose an Email to info@intelligencepromo.com',
            ],
            [
                'id'    => 2,
                'question' => 'How do I participate in this promotion?',
                'answer' => 'Compose an Email to info@intelligencepromo.com with the subject Register for Promotion. Remember to include your details',
            ],
            [
                'id'    => 3,
                'question' => 'How many times can I participate in a day?',
                'answer' => 'For the campaigns, our participants are only allowed to participate once a day.',
            ],
            [
                'id'    => 4,
                'question' => 'How much does it cost to send an SMS?',
                'answer' => 'Sending SMS to Participate cost 1.00 ksh.',
            ],
            [
                'id'    => 5,
                'question' => 'What are the prizes to be won?',
                'answer' => 'Our Prizes are in Cash or Airtime.',
            ],
        ];

        FAQs::insert($faqs);
    }
}
