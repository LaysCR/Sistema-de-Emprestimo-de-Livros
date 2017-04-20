<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\User;
use App\Models\Book;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $users = User::all();
      $notifications = Notification::all();

      return view('admin.loan', [
        'users' => $users,
        'notifications' => $notifications
      ]);
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

      try{
          $notification = new Notification();
          $notification->user_id = $request->user;
          $notification->book_id = $request->book;
          $notification->type = 'request';
          $notification->read = false;

          $book = Book::findOrFail($request->book);
          $book->bk_availability = false;

          $notification->save();
          $book->save();


          return new JsonResponse([$notification, 200]);

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
    public function destroy(Notification $notification)
    {
      //Book status
      $book = Book::findOrFail($notification->book_id);
      $book->bk_availability = true;

      //Save
      $book->save();

      //Delete
      $notification->delete();

      return redirect('/admin/loan');
    }
}
