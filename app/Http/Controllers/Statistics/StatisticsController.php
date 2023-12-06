<?php

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class StatisticsController extends Controller
{
    public function charts(Request $request): Response
    {
        /** @var User $user */
        $user = Auth::user();
        return Inertia::render('Statistics/Charts', [
           'charts' => $user->charts
        ]);
    }
}
