<?php

namespace Database\Seeders;

use App\Models\Admin\LegalPage;
use App\Models\Admin\Page;
use App\Models\Admin\Service;
use App\Models\Admin\WebsiteConfiguration;
use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\LegalPageSeeder;
use Database\Seeders\WebsiteConfigSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Only seed if users table is empty
        if (User::count() === 0) {
            $this->call(AdminUserSeeder::class);
            $this->command->info('Admin user seeded successfully.');
        } else {
            $this->command->info('Users already exist. Skipping AdminUserSeeder.');
        }

        // Only seed if pages table is empty
        if (Page::count() === 0) {
            $this->call(PageSeeder::class);
            $this->command->info('Pages seeded successfully.');
        } else {
            $this->command->info('Pages already exist. Skipping PageSeeder.');
        }

        // Only seed if website configurations table is empty
        if (WebsiteConfiguration::count() === 0) {
            $this->call(WebsiteConfigSeeder::class);
            $this->command->info('Website configurations seeded successfully.');
        } else {
            $this->command->info('Website configurations already exist. Skipping WebsiteConfigSeeder.');
        }

        // Only seed if website configurations table is empty php artisan db:seed --class=LegalPageSeeder
        if (LegalPage::count() === 0) {
            $this->call(LegalPageSeeder::class);
            $this->command->info('Legal pages seeded successfully.');
        } else {
            $this->command->info('Legal pages already exist. Skipping LegalPageSeeder.');
        }

        // Only seed if services table is empty php artisan db:seed --class=ServiceSeeder
        if (Service::count() === 0) {
            $this->call(ServiceSeeder::class);
            $this->command->info('Services seeded successfully.');
        } else {
            $this->command->info('Services already exist. Skipping ServiceSeeder.');
        }


        $this->command->info('All seeders completed!');
    }
}
