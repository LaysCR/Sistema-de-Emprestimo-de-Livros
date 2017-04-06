<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\User;
use App\Models\Book;
use App\Models\Loan;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $books = Book::all();
        $loans = Loan::all();

        return view('admin.loan', [
          'users' => $users,
          'books' => $books,
          'loans' => $loans
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
        $today = new \DateTime();
        $due = new \DateTime();
        $due->add(new \DateInterval("P14D"));
        try{
          $loan = new Loan();
          $loan->ln_user_id = $request->user;
          $loan->ln_bk_id = $request->book;
          $loan->ln_date = $today->format('Y-m-d');
          $loan->ln_due_date = $due->format('Y-m-d');
          $loan->ln_status = 'ok';
          $loan->save();

          return new JsonResponse([$loan, 200]);
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
    public function destroy($id)
    {
        //
    }
}
