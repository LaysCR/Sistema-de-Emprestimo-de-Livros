<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Book;
use App\Models\Publisher;

class BookController extends Controller
{

    public function __construct()
    {
      //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = Book::all();
        $publishers = Publisher::pluck('pub_name', 'pub_id');

        return view('admin.book', ['books' => $books,
                                    'publishers' => $publishers ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
          'bk_name' => 'required|max:240',
          'bk_author' => 'required|max:240',
          'bk_owner' => 'required|max:240',
          'bk_description' => 'required|max:240'
        ]);



        try{
          $book = new Book();
          $book->bk_name = $request->bk_name;
          $book->bk_author = $request->bk_author;
          $book->bk_owner = $request->bk_owner;
          $book->bk_description = $request->bk_description;
          $book->bk_pub_id = $request->bk_pub_id;

          $book->save();

          return new JsonResponse([$book, 200]);

        } catch(\Exception $e){
          throw $e;
        }

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect('/');
    }
}
