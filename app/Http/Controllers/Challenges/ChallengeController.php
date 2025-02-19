<?php

namespace App\Http\Controllers\Challenges;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChallengeController extends Controller
{
    public function index() {
        return Inertia::render('Challenges/Index');
    }

    public function show() {
        
    }
}
