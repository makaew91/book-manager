<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function UserBooks($user)
    {
       return DB::table('books')
           ->leftJoin('genres', 'genres.id', '=', 'books.genre_id')
           ->select('books.id', 'books.title', 'books.author', 'books.publication', 'books.genre_id', 'genres.name')
           ->where('books.user_id', $user)->get();
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $id)
    {
        try {
            $book = new Books();
            $book->genre_id = $request->genre;
            $book->user_id = $id;
            $book->author = $request->author;
            $book->title = $request->name;
            $book->publication = $request->date;

            $book->save();

            $books = $this->UserBooks($id);
            return response()->json([
                "status" => 200,
                "books" => $books]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
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
        return DB::table('books')
            ->select('books.*')
            ->where('id', $id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $book = Books::find($id);
        $book->update([
            "genre_id" => $request->genre_id,
            "author" => $request->author,
            "title" => $request->title,
            "publication" => $request->date
        ]);

        $books = $this->UserBooks($request->user_id);
        return response()->json([
            "status" => 200,
            "books" => $books]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Books::find($id);
        $book->delete();
    }
}
