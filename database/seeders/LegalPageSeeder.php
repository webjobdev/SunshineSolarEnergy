<?php

namespace Database\Seeders;

use App\Models\Admin\LegalPage;
use Illuminate\Database\Seeder;

class LegalPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'type' => 'about',
                'title' => 'About Us',
                'description' => '<p>Write about your company here...</p>',
            ],
            [
                'type' => 'privacy-policy',
                'title' => 'Privacy Policy',
                'description' => '<p>Write your privacy policy here...</p>',
            ],
            [
                'type' => 'terms-conditions',
                'title' => 'Terms & Conditions',
                'description' => '<p>Write your terms and conditions here...</p>',
            ],
            [
                'type' => 'disclaimer',
                'title' => 'Disclaimer',
                'description' => '<p>Write your disclaimer here...</p>',
            ],
            [
                'type' => 'refund-cancellation-policy',
                'title' => 'Refund & Cancellation Policy',
                'description' => '<p>Write your refund and cancellation policy here...</p>',
            ],
        ];

        foreach ($pages as $page) {
            LegalPage::updateOrCreate(
                ['type' => $page['type']],
                $page
            );
        }
    }
}