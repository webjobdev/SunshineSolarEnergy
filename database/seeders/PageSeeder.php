<?php

namespace Database\Seeders;

use App\Models\Admin\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Home Page
        Page::create([
            'page_name' => 'Home',
            'slug' => 'home',
            'meta_title' => 'RK IT Consultant - Engineering Tomorrow\'s Technology',
            'meta_description' => 'Expert Web Development, Mobile Apps, AI Agents, Automation, OTT Streaming Platforms & Digital Marketing services for global businesses.',
            'meta_keywords' => 'IT consultant, web development, mobile app development, AI agents, automation, OTT streaming, digital marketing, software development, India',
            'focus_keyword' => 'IT consultant India',
            'canonical_url' => null,
            'robots' => 'index,follow',
            'status' => 'active',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        // About Page
        Page::create([
            'page_name' => 'About Us',
            'slug' => 'about',
            'meta_title' => 'About RK IT Consultant - The Team Behind Tomorrow\'s Technology',
            'meta_description' => 'About RK IT Consultant — a global-quality, India-based IT team specializing in Web, Mobile, AI Agents, OTT Streaming, and Digital Marketing.',
            'meta_keywords' => 'about IT consultant, India IT team, web development company, mobile app developers, AI company India, OTT platform development',
            'focus_keyword' => 'IT consulting company',
            'canonical_url' => null,
            'robots' => 'index,follow',
            'status' => 'active',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        // Services Page
        Page::create([
            'page_name' => 'Services',
            'slug' => 'services',
            'meta_title' => 'IT Services - Web, Mobile, AI, OTT & Digital Marketing | RK IT Consultant',
            'meta_description' => 'RK IT Consultant services: Web Development, Mobile Apps, Software Development, AI Agents & Automation, OTT Streaming Platforms, and Digital Marketing.',
            'meta_keywords' => 'IT services, web development services, mobile app development, AI services, OTT platform development, digital marketing services, software development India',
            'focus_keyword' => 'IT services India',
            'canonical_url' => null,
            'robots' => 'index,follow',
            'status' => 'active',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        // Contact Page
        Page::create([
            'page_name' => 'Contact Us',
            'slug' => 'contact',
            'meta_title' => 'Contact RK IT Consultant - Free Consultation for Your Project',
            'meta_description' => 'Contact RK IT Consultant — free 30-minute consultation for your Web, Mobile, AI, OTT, or Digital Marketing project. We respond within 4 hours.',
            'meta_keywords' => 'contact IT consultant, free consultation, web development quote, mobile app development contact, AI solutions inquiry, OTT platform consultation',
            'focus_keyword' => 'IT consultant contact',
            'canonical_url' => null,
            'robots' => 'index,follow',
            'status' => 'active',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
    }
}