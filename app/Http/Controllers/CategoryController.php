<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            if (Gate::allows('manage-categories')) return $next($request);
            abort(403);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories     = Category::paginate(10);
        $filterKeyword  = $request->get('keyword');
        if ($filterKeyword) {
            $categories = Category::where('name', 'LIKE', "%$filterKeyword%")->paginate(10);
        }

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            "name"      => "required|min:3|max:20",
            "image"     => "required"
        ])->validate();

        $name                   = $request->get('name');
        $category               = new Category();
        $category->name         = $name;
        if ($request->file('image')) {
            $image_path = $request->file('image')->store('category_images', 'public');
            $category->image = $image_path;
        }
        $category->created_by   = Auth::user()->id;
        $category->slug         = Str::slug($name, '-');
        $category->save();

        return redirect()->route('categories.create')->with('status', 'Category Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category           = Category::findOrFail($id);

        Validator::make($request->all(), [
            "name"      => "required|min:3|max:20",
            "image"     => "required",
        ]);

        $name               = $request->get('name');
        $category->name     = $name;
        if ($request->file('image')) {
            if ($category->image && file_exists(storage_path('app/public/' . $category->image))) {
                Storage::delete('public/' . $category->image);
            }
            $new_image = $request->file('image')->store('categories_images', 'public');
            $category->image = $new_image;
        }
        $category->updated_by   = Auth::user()->id;
        $category->slug         = Str::slug($name);
        $category->save();

        return redirect()->route('categories.edit', [$id])->with('status', 'Category Successfully Updated.');;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('status', 'Category Successfully Moved to Trash.');
    }

    /**
     * Trash a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $trash_category = Category::onlyTrashed()->paginate(10);

        return view('categories.trash', compact('trash_category'));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        if ($category->trashed()) {
            $category->restore();
        } else {
            return redirect()->route('categories.index')->with('status', 'Category is not in trash.');
        }

        return redirect()->route('categories.index')->with('status', 'Category successfully restored.');
    }

    /**
     * Remove Permanent the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletePermanent($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        if (!$category->trashed()) {
            return redirect()->route('categories.index')->with('status', 'Can not delete permanent active category.');
        } else {
            $category->forceDelete();
            return redirect()->route('categories.index')->with('status', 'Category permanently deleted.');
        }
    }

    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');
        $categories = Category::where("name", "LIKE", "%$keyword%")->get();

        return $categories;
    }
}
