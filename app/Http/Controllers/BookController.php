<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->get('status');
        $keyword = $request->get('keyword') ? $request->get('keyword') : '';

        if ($status) {
            $books = Book::with('categories')->where('title', "LIKE", "%$keyword%")->where('status', strtoupper($status))->paginate(10);
        } else {
            $books = Book::with('categories')->where('title', "LIKE", "%$keyword%")->paginate(10);
        }

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title              = $request->get('title');
        $save_action        = $request->get('save_action');
        $book               = new Book();
        $book->title        = $title;
        $book->slug         = Str::slug($title);
        $book->description  = $request->get('description');
        $book->author       = $request->get('author');
        $book->publisher    = $request->get('publisher');
        $book->price        = $request->get('price');
        $book->stock        = $request->get('stock');
        $book->status       = $save_action;
        $book->created_by   = Auth::user()->id;
        $cover              = $request->file('cover');
        if ($cover) {
            $cover_path     = $cover->store('book-covers', 'public');
            $book->cover    = $cover_path;
        }
        $book->save();
        $book->categories()->attach($request->get('categories'));

        if ($save_action == 'PUBLISH') {
            return redirect()->route('books.create')->with('status', 'Book successfully saved and published.');
        } else {
            return redirect()->route('books.create')->with('status', 'Book saved as draft.');
        }

        return redirect()->route('books.create')->with('status', 'Book Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);

        return view('books.edit', compact('book'));
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
        $title              = $request->get('title');
        $book               = Book::findOrFail($id);
        $book->title        = $title;
        $book->slug         = Str::slug($title);
        $book->description  = $request->get('description');
        $book->author       = $request->get('author');
        $book->publisher    = $request->get('publisher');
        $book->stock        = $request->get('stock');
        $book->price        = $request->get('price');
        $book->status       = $request->get('status');
        $new_cover          = $request->file('cover');
        if ($new_cover) {
            if ($book->cover && file_exists(storage_path('app/public/' . $book->cover))) {
                Storage::delete('public/' . $book->cover);
            }
            $new_cover_path = $new_cover->store('book-covers', 'public');
            $book->cover    = $new_cover_path;
        }
        $book->updated_by   = Auth::user()->id;
        $book->save();
        $book->categories()->sync($request->get('categories'));

        return redirect()->route('books.edit', [$book->id])->with('status', 'Book successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('status', 'Book moved to trash.');
    }

    /**
     * Trash a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $trash_book = Book::onlyTrashed()->paginate(10);

        return view('books.trash', compact('trash_book'));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        $book = Book::withTrashed()->findOrFail($id);
        if ($book->trashed()) {
            $book->restore();
        } else {
            return redirect()->route('books.index')->with('status', 'Book is not in trash.');
        }

        return redirect()->route('books.index')->with('status', 'Book successfully restored.');
    }

    /**
     * Remove Permanent the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletePermanent($id)
    {
        $book = Book::withTrashed()->findOrFail($id);
        if (!$book->trashed()) {
            return redirect()->route('books.index')->with('status', 'Book is not in trash!');
        } else {
            $book->categories()->detach();
            $book->forceDelete();
            return redirect()->route('books.index')->with('status', 'Book permanently deleted.');
        }
    }
}
