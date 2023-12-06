<?php

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use App\Http\Requests\statistics\charts\AddChartsRequest;
use App\Models\User;
use App\Services\Statistics\ChartIntervals;
use App\Services\Statistics\ChartTypes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ChartsController extends Controller
{
    public function add(AddChartsRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $data = array_merge($request->all(),[
            'x'=>0,
            'y'=>0,
            'w'=>4,
            'h'=>4,
            'i'=> $user->charts()->max('i')+1,
        ]);
        $user->charts()->create($data);
        return Redirect::back();
    }

    public function types()
    {
        return response(['types' => ChartTypes::getValueNameList()]);
    }

    public function intervals()
    {
        return response(['intervals' => ChartIntervals::getValueNameList()]);
    }
}
