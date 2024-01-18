<?php

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use App\Http\Resources\ChartResource;
use App\Models\Chart;
use App\Models\User;
use Carbon\Carbon;
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
        $charts = $user->charts()->with('categories')->get();
        return Inertia::render('Statistics/Charts', [
            'charts' => ChartResource::collection($charts)->toArray($request)
        ]);
    }
}
