<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure the 'public/images' and 'public/audio' directories exist (optional, but good practice)
        // Storage::disk('public')->makeDirectory('images', 0755, true, true);
        // Storage::disk('public')->makeDirectory('audio', 0755, true, true);

        // Example items - replace with your actual data and file paths
        Item::create([
            'name' => 'cat',
            'image_path' => 'storage/games/images/cat.jpg',
            'audio_instruction_path' => 'storage/games/audios/cat.mp3',
        ]);
        Item::create([
            'name' => 'Dog',
            'image_path' => 'storage/games/images/dog.jpg',
            'audio_instruction_path' => 'storage/games/audios/dog.mp3',
        ]);
        Item::create([
            'name' => 'Blue Car',
            'image_path' => 'storage/games/images/blueCar.jpg',
            'audio_instruction_path' => 'storage/games/audios/blueCar.mp3',
        ]);
        Item::create([
            'name' => 'Pen',
            'image_path' => 'storage/games/images/pen.jpg',
            'audio_instruction_path' => 'storage/games/audios/pen.mp3',
        ]);
  
    }
}
