<?php

namespace Database\Seeders;

use App\Models\Admin\WebsiteConfiguration;
use Illuminate\Database\Seeder;

class WebsiteConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $configs = [
            // General Settings
            [
                'config_key' => 'web_name',
                'config_value' => 'Rkit Consultant',
                'config_type' => 'text',
                'config_group' => 'general',
                'config_label' => 'Website Name',
                'config_placeholder' => 'Enter website name',
                'is_required' => true,
                'sort_order' => 1,
            ],
            [
                'config_key' => 'web_tagline',
                'config_value' => 'Innovative Solutions',
                'config_type' => 'text',
                'config_group' => 'general',
                'config_label' => 'Website Tagline',
                'config_placeholder' => 'Enter tagline',
                'sort_order' => 2,
            ],
            [
                'config_key' => 'web_logo',
                'config_value' => 'https://cdn-icons-png.flaticon.com/256/12535/12535769.png',
                'config_type' => 'image',
                'config_group' => 'general',
                'config_label' => 'Website Logo',
                'config_help' => 'Recommended size: 200x60 pixels',
                'sort_order' => 3,
            ],
            [
                'config_key' => 'web_favicon',
                'config_value' => 'https://cdn-icons-png.flaticon.com/256/12535/12535769.png',
                'config_type' => 'image',
                'config_group' => 'general',
                'config_label' => 'Favicon',
                'config_help' => 'Recommended: 32x32 or 64x64 pixels',
                'sort_order' => 4,
            ],
            
            // Contact Settings
            [
                'config_key' => 'contact_email',
                'config_value' => 'info@rkitconsultant.com',
                'config_type' => 'email',
                'config_group' => 'contact',
                'config_label' => 'Contact Email',
                'config_placeholder' => 'Enter email',
                'is_required' => true,
                'sort_order' => 1,
            ],
            [
                'config_key' => 'contact_phone',
                'config_value' => '+91-1234567890',
                'config_type' => 'text',
                'config_group' => 'contact',
                'config_label' => 'Phone Number',
                'config_placeholder' => 'Enter phone number',
                'sort_order' => 2,
            ],
            [
                'config_key' => 'contact_address',
                'config_value' => '123, Business Park, Mumbai, India',
                'config_type' => 'textarea',
                'config_group' => 'contact',
                'config_label' => 'Address',
                'config_placeholder' => 'Enter address',
                'sort_order' => 3,
            ],
            
            // Social Settings
            [
                'config_key' => 'social_facebook',
                'config_value' => 'https://facebook.com/rkitconsultant',
                'config_type' => 'url',
                'config_group' => 'social',
                'config_label' => 'Facebook URL',
                'config_placeholder' => 'Enter Facebook URL',
                'sort_order' => 1,
            ],
            [
                'config_key' => 'social_twitter',
                'config_value' => 'https://twitter.com/rkitconsultant',
                'config_type' => 'url',
                'config_group' => 'social',
                'config_label' => 'Twitter URL',
                'config_placeholder' => 'Enter Twitter URL',
                'sort_order' => 2,
            ],
            [
                'config_key' => 'social_instagram',
                'config_value' => 'https://instagram.com/rkitconsultant',
                'config_type' => 'url',
                'config_group' => 'social',
                'config_label' => 'Instagram URL',
                'config_placeholder' => 'Enter Instagram URL',
                'sort_order' => 3,
            ],
            [
                'config_key' => 'social_linkedin',
                'config_value' => 'https://linkedin.com/company/rkitconsultant',
                'config_type' => 'url',
                'config_group' => 'social',
                'config_label' => 'LinkedIn URL',
                'config_placeholder' => 'Enter LinkedIn URL',
                'sort_order' => 4,
            ],
            [
                'config_key' => 'social_youtube',
                'config_value' => 'https://youtube.com/rkitconsultant',
                'config_type' => 'url',
                'config_group' => 'social',
                'config_label' => 'YouTube URL',
                'config_placeholder' => 'Enter YouTube URL',
                'sort_order' => 5,
            ],
            
            // SEO Settings
            [
                'config_key' => 'seo_meta_title',
                'config_value' => 'Rkit Consultant - Professional Solutions',
                'config_type' => 'text',
                'config_group' => 'seo',
                'config_label' => 'Default Meta Title',
                'config_placeholder' => 'Enter meta title',
                'sort_order' => 1,
            ],
            [
                'config_key' => 'seo_meta_description',
                'config_value' => 'Best consulting services for your business growth',
                'config_type' => 'textarea',
                'config_group' => 'seo',
                'config_label' => 'Default Meta Description',
                'config_placeholder' => 'Enter meta description',
                'sort_order' => 2,
            ],
            [
                'config_key' => 'seo_og_image',
                'config_value' => 'https://cdn-icons-png.flaticon.com/256/12535/12535769.png',
                'config_type' => 'image',
                'config_group' => 'seo',
                'config_label' => 'Social Share Image',
                'config_help' => 'Recommended size: 1200x630 pixels',
                'sort_order' => 3,
            ],
            
            // Footer Settings
            [
                'config_key' => 'footer_text',
                'config_value' => '© 2026 Rkit Consultant. All rights reserved.',
                'config_type' => 'text',
                'config_group' => 'footer',
                'config_label' => 'Footer Text',
                'config_placeholder' => 'Enter footer text',
                'sort_order' => 1,
            ],
            [
                'config_key' => 'footer_logo',
                'config_value' => null,
                'config_type' => 'image',
                'config_group' => 'footer',
                'config_label' => 'Footer Logo',
                'config_help' => 'Recommended size: 150x50 pixels',
                'sort_order' => 2,
            ],
        ];

        foreach ($configs as $config) {
            WebsiteConfiguration::create($config);
        }
    }
}