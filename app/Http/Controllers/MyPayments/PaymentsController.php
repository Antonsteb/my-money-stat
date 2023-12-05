<?php

namespace App\Http\Controllers\MyPayments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payments\SetCategoryRequest;
use App\Models\payments\BankPayment;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class PaymentsController extends Controller
{

    public function list(Request $request): Response
    {
        /** @var User $user */
        $user = Auth::user();
        return Inertia::render('MyPayments/List', ['payments' => $user->bankPayments]);
    }

    public function setCategory(SetCategoryRequest $request): RedirectResponse
    {
;
        /** @var User $user */
        $user = Auth::user();
        /** @var BankPayment $bankPayment */
        $bankPayment = $user->bankPayments()->find($request->payment_id);
        $category = $user->categories()->find($request->category_id);

        $bankPayment->categories()->sync($category);
        return Redirect::back()->with('success', 'User created.');
    }


}
