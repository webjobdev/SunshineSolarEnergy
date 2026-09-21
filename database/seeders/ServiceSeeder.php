<?php

namespace Database\Seeders;

use App\Models\Admin\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Solar Panel Installation',
                'slug' => 'solar-panel-installation',
                'short_description' => 'Professional solar panel installation for homes and businesses.',
                'description' => 'Our professional solar panel installation service provides complete installation solutions for residential and commercial properties. We help customers choose the right solar system, install the panels correctly, and ensure reliable energy generation.',
                'thumbnail' => 'service/thumbnails/solar-panel-installation.jpg',
                'sort_order' => 1,
                'status' => 'active',
            ],
            [
                'name' => 'Solar System Maintenance',
                'slug' => 'solar-system-maintenance',
                'short_description' => 'Reliable maintenance services to keep your solar system performing efficiently.',
                'description' => 'Regular solar system maintenance helps maintain efficient energy generation and extend the life of your solar equipment. Our service includes system inspection, performance checks, and maintenance of essential components.',
                'thumbnail' => 'service/thumbnails/solar-system-maintenance.jpg',
                'sort_order' => 2,
                'status' => 'active',
            ],
            [
                'name' => 'Solar Panel Cleaning',
                'slug' => 'solar-panel-cleaning',
                'short_description' => 'Professional solar panel cleaning to maintain maximum energy generation.',
                'description' => 'Dust, dirt, and other deposits can reduce solar panel efficiency. Our professional solar panel cleaning service helps keep your panels clean and supports consistent solar energy generation.',
                'thumbnail' => 'service/thumbnails/solar-panel-cleaning.jpg',
                'sort_order' => 3,
                'status' => 'active',
            ],
            [
                'name' => 'Solar Inverter Installation',
                'slug' => 'solar-inverter-installation',
                'short_description' => 'Complete inverter installation and configuration for residential and commercial systems.',
                'description' => 'We provide solar inverter installation and configuration services for residential and commercial solar systems. Our service focuses on proper installation, system configuration, and reliable operation of the inverter.',
                'thumbnail' => 'service/thumbnails/solar-inverter-installation.jpg',
                'sort_order' => 4,
                'status' => 'active',
            ],
            [
                'name' => 'Solar Battery Solutions',
                'slug' => 'solar-battery-solutions',
                'short_description' => 'Battery storage solutions for backup power and better solar energy utilization.',
                'description' => 'Our solar battery solutions provide energy storage for backup power and improved utilization of generated solar energy. We help customers select and implement suitable battery storage solutions for their requirements.',
                'thumbnail' => 'service/thumbnails/solar-battery-solutions.jpg',
                'sort_order' => 5,
                'status' => 'active',
            ],
            [
                'name' => 'Rooftop Solar Solutions',
                'slug' => 'rooftop-solar-solutions',
                'short_description' => 'Customized rooftop solar solutions designed to reduce electricity costs.',
                'description' => 'Our rooftop solar solutions are designed according to the available roof space and energy requirements of each property. We provide customized solutions for homes, offices, shops, and other buildings.',
                'thumbnail' => 'service/thumbnails/rooftop-solar-solutions.jpg',
                'sort_order' => 6,
                'status' => 'active',
            ],
            [
                'name' => 'Commercial Solar Solutions',
                'slug' => 'commercial-solar-solutions',
                'short_description' => 'Large-scale solar solutions for offices, factories, shops and commercial properties.',
                'description' => 'We provide commercial solar solutions for offices, factories, shops, warehouses, and other commercial properties. Our solutions are planned according to energy consumption, available space, and business requirements.',
                'thumbnail' => 'service/thumbnails/commercial-solar-solutions.jpg',
                'sort_order' => 7,
                'status' => 'active',
            ],
            [
                'name' => 'Solar System Consultation',
                'slug' => 'solar-system-consultation',
                'short_description' => 'Expert consultation to select the right solar system according to your energy needs.',
                'description' => 'Our solar system consultation service helps customers understand their solar requirements and select a suitable system. We consider energy usage, property requirements, available space, and other important factors.',
                'thumbnail' => 'service/thumbnails/solar-system-consultation.jpg',
                'sort_order' => 8,
                'status' => 'active',
            ],
            [
                'name' => 'Solar System Inspection',
                'slug' => 'solar-system-inspection',
                'short_description' => 'Detailed solar system inspection to identify performance and installation issues.',
                'description' => 'Our solar system inspection service checks the condition and performance of solar equipment. We identify potential installation, connection, and performance issues to help maintain reliable system operation.',
                'thumbnail' => 'service/thumbnails/solar-system-inspection.jpg',
                'sort_order' => 9,
                'status' => 'active',
            ],
            [
                'name' => 'Solar Repair & Support',
                'slug' => 'solar-repair-support',
                'short_description' => 'Fast and reliable repair and technical support for solar energy systems.',
                'description' => 'Our solar repair and technical support service helps resolve common system issues and maintain reliable solar energy generation. We provide support for troubleshooting, repairs, and system-related technical problems.',
                'thumbnail' => 'service/thumbnails/solar-repair-support.jpg',
                'sort_order' => 10,
                'status' => 'active',
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['slug' => $service['slug']],
                $service
            );
        }

        $this->command?->info('10 services seeded successfully.');
    }
}