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
        $books = Book::where('bk_availability', true)->get();
        $loans = Loan::orderBy("ln_due_date")->get();

        $today = new \DateTime();

        foreach ($loans as $loan) {
          $dueDate = new \DateTime($loan->ln_due_date);
          $dateDiff = date_diff($dueDate, $today);
          if ($dateDiff->d > 0 && $dateDiff->invert == 1) {
              $loan->ln_status = 0; // Em dia
          } else if($dateDiff->d == 0) {
              $loan->ln_status = 1; //Vence hoje
          } else if($dateDiff->d > 0 && $dateDiff->invert == 0) {
              $loan->ln_status = 2; //Vencido
          }
          $loan->save();
        }

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
          //New loan
          $loan = new Loan();
          $loan->ln_user_id = $request->user;
          $loan->ln_bk_id = $request->book;
          $loan->ln_date = $today;
          $loan->ln_due_date = $due;
          $loan->ln_status = 0;

          //Book status
          $book = Book::findOrFail($request->book);
          $book->bk_availability = false;

          //Save
          $book->save();
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
    public function destroy(Loan $loan)
    {

      //Book status
      $book = Book::findOrFail($loan->ln_bk_id);
      $book->bk_availability = true;

      //Save
      $book->save();

      //Delete
      $loan->delete();

      return redirect('/admin/loan');
    }
}
