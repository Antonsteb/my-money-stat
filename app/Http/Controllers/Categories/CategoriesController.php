<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\categories\AddCategoryRequest;
use App\Http\Requests\categories\DeleteCategoryRequest;
use App\Http\Requests\categories\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class CategoriesController extends Controller
{

    public function list(Request $request): Response
    {
        /** @var User $user */
        $user = Auth::user();
        $categories = $user->categories()->whereNull('parent_id')->with('subcategories')->get();
        return Inertia::render('Categories/List', ['categories' => $categories]);
    }

    public function add(AddCategoryRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();
        $user->categories()->create($request->all());
        return Redirect::back();
    }
    public function edit(UpdateCategoryRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();
        /** @var Category $category */
        $category = $user->categories()->find($request->id);
        $category->update($request->except('id'));
        return redirect('/categories');
    }
    public function delete($id)
    {
        /** @var User $user */
        $user = Auth::user();
        /** @var Category $category */
        $category = $user->categories()->find($id);
        $category->delete();
        return response('');
    }

    public function all(Request $request): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
    {
        /** @var User $user */
        $user = Auth::user();
        $categories = $user->categories()->whereNull('parent_id')->with('subcategories')->get();
        return  response(['categories' => $categories]);
    }
}
