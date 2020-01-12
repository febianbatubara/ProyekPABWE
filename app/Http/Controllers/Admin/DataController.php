<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Author;
use App\Book;
use App\BorrowHistory;
use App\User;

class DataController extends Controller
{
    public function authors()
     {

        $authors=Author::orderBy('name', 'ASC');

        return datatables()->of($authors)
                ->addColumn('action', 'admin.author.action')
                ->addIndexColumn()
                ->toJson();
    }

    public function books()
     {

        $books=Book::with('author')->orderBy('title', 'ASC');

        return datatables()->of($books)
                ->addColumn('author', function(book $model){
                    return $model->author->name;
                })
                ->editColumn('cover', function (book $model){
                    return '<img src="'. $model->getCover() .'" height="150px" >';
                })
                ->addColumn('action', 'admin.book.action')
                ->addIndexColumn()
                ->rawColumns(['cover','action'])
                ->toJson();
    }

    public function borrows(){
        $borrows = BorrowHistory::with('user', 'book')->isBorrowed()->latest();

        return datatables()->of($borrows)
                ->addColumn('user', function(BorrowHistory $model){
                    return $model->user->name;
                })
                ->addColumn('book_title', function(BorrowHistory $model){
                    return $model->book->title;
                })
                ->addColumn('action', 'admin.borrow.action')
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->toJson(); 
    }

    public function users()
     {

        $users=User::orderBy('id', 'ASC');

        return datatables()->of($users)
                // ->addColumn('user', function(user $model){
                //    return $model->user->id;
                // })
                // ->editColumn('cover', function (book $model){
                //     return '<img src="'. $model->getCover() .'" height="150px" >';
                // })
                // ->addColumn('action', 'admin.book.action')
                ->addIndexColumn()
                // ->rawColumns(['cover','action'])
                ->toJson();
    }
}

 