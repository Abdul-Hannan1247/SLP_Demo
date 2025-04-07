<?php

use App\Http\Controllers\Games\FindItemGameController;
use Illuminate\Support\Facades\Route;

Route::post('/find-item-game/check-answer', [FindItemGameController::class, 'checkAnswer'])->name('find_item_game.check_answer');