<?php

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use App\Http\Requests\statistics\charts\AddChartsRequest;
use App\Http\Requests\statistics\charts\UpdateChartsPositionRequest;
use App\Http\Requests\statistics\charts\UpdateChartsSizeRequest;
use App\Models\Chart;
use App\Models\users\User;
use App\Services\Statistics\ChartIntervals;
use App\Services\Statistics\ChartTypes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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

    public function updatePosition(UpdateChartsPositionRequest $request, Chart $chart)
    {
        $chart->fill($request->all(['x', 'y']))->save();
        return response($chart);
    }

    public function updateSize(UpdateChartsSizeRequest $request, Chart $chart)
    {
        $chart->fill($request->all(['w', 'h']))->save();
        return response($chart);
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
