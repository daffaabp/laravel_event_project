<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tag;
use App\Models\City;
use App\Models\User;
use App\Models\Country;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Country::create(['name' => 'Jakarta']);
        Country::create(['name' => 'Jawa Barat']);
        Country::create(['name' => 'Jawa Tengah']);
        Country::create(['name' => 'Jawa Timur']);
        Country::create(['name' => 'Yogyakarta']);
        City::create(['country_id' => 1, 'name' => 'Kebayoran Baru']);
        City::create(['country_id' => 1, 'name' => 'Pondok Indah']);
        City::create(['country_id' => 1, 'name' => 'Menteng']);
        City::create(['country_id' => 2, 'name' => 'Bandung']);
        City::create(['country_id' => 2, 'name' => 'Karawang']);
        City::create(['country_id' => 2, 'name' => 'Tasikmalaya']);
        City::create(['country_id' => 3, 'name' => 'Semarang']);
        City::create(['country_id' => 3, 'name' => 'Banyumas']);
        City::create(['country_id' => 3, 'name' => 'Surakarta']);
        City::create(['country_id' => 4, 'name' => 'Bojonegoro']);
        City::create(['country_id' => 4, 'name' => 'Banyuwangi']);
        City::create(['country_id' => 4, 'name' => 'Jember']);
        City::create(['country_id' => 5, 'name' => 'Bantul']);
        City::create(['country_id' => 5, 'name' => 'Sleman']);
        City::create(['country_id' => 5, 'name' => 'Gunungkidul']);

        Tag::create(['name' => 'Seminar', 'slug' => 'seminar']);
        Tag::create(['name' => 'Webinar', 'slug' => 'webinar']);
        Tag::create(['name' => 'Technology', 'slug' => 'technology']);
        Tag::create(['name' => 'Code', 'slug' => 'Code']);
    }
}