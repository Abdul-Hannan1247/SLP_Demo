<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class FindItemGameController extends Controller
{
    public function index()
    {
        $items = Item::all()->shuffle()->take(4); // Get 4 random items for the game
        $targetItem = $items->random();

        return view('games.find_item_game', compact('items', 'targetItem'));
    }

    public function checkAnswer(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'target_item_id' => 'required|exists:items,id',
        ]);

        if ($request->input('item_id') == $request->input('target_item_id')) {
            return response()->json(['correct' => true]);
        } else {
            return response()->json(['correct' => false]);
        }
    }
}