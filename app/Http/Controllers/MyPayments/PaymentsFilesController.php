<?php

namespace App\Http\Controllers\MyPayments;

use App\Http\Controllers\Controller;
use App\Http\Requests\files\AddPaymentsFileRequest;
use App\Models\users\User;
use App\Services\Payments\Upload\TypeLoader;
use App\Services\RabbitMQService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class PaymentsFilesController extends Controller
{

    public function list(Request $request): Response
    {
        $files = Auth::user()->paymentsUpload;
        return Inertia::render('MyPayments/List', compact($files));
    }

    public function add(AddPaymentsFileRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $fileName = $user->id . '/'. $request->file('file')->getClientOriginalName();

        $path = $request->file('file')->storeAs('payments',$fileName);
        $paymentsUpload = $user->paymentsUpload()->create([
            'bank_name' => $request->bank,
            'type' => TypeLoader::File,
        ]);
        $message = json_encode(['id' => $paymentsUpload->id, 'path' => $fileName]);
        (new RabbitMQService())->publish($message,'payments','upload');
        return Redirect::back()->with('success', 'User created.');
    }
}
