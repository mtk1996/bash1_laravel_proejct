<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //users
        User::create([
            'name' => "User One",
            'email' => "userone@a.com",
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => "Admin",
            'email' => "admin@a.com",
            'password' => Hash::make('password'),
            'role' => "admin"
        ]);


        //Category
        $category = ['Shirt', 'Shoe', 'Hat', 'pants', 'electronic', 'phone', 'computer'];
        foreach ($category as  $c) {
            Category::create([
                'slug' => Str::slug($c),
                'name' => $c,
            ]);
        }

        //size
        $size = ['Small', 'medium', 'Large'];
        foreach ($size as $c) {
            Size::create([
                'slug' => Str::slug($c),
                'name' => $c,
            ]);
        }

        //color
        //size
        $color = ['Red', 'Green', 'Blue'];
        foreach ($color as $c) {
            Color::create([
                'slug' => Str::slug($c),
                'name' => $c,
            ]);
        }
    }
}
