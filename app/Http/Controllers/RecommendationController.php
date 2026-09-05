<?php

namespace App\Http\Controllers;

use App\Services\RecommendationService;
use Illuminate\Support\Facades\Auth;

class RecommendationController extends Controller
{
    public function index(RecommendationService $service)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $recommendations = $service->forUser(Auth::user());

        return view('layouts.recommendations', compact('recommendations'));
    }
}
