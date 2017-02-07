<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTExceptions;
use JWTAuth;
use App\Models\book;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class ApiBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $token = $request->input('token');
        //var_dump($token);
        $user = JWTAuth::toUser($token);
        //var_dump($user->email);
        //var_dump($user->name);
        //var_dump("USER ID  : " . $user->id);
        //var_dump($user->password);

        $books = book::where('user_id', $user->id);
        $books = $books->get()->toArray();
        //var_dump($books);

        return ($books);
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
        $token = $request->input('token');
        //var_dump($token);
        $user = JWTAuth::toUser($token);

        if (count(book::where(['isbn' => $request->isbn, 'user_id' => $user->id])->get()->toArray()) == 0)
            {
                $book = new book;
                $book->isbn = $request->isbn;
                $book->user_id = $user->id;
                $book->category_id = 1;
                $book->status_id = 1;
                $book->save();
                return response()->json(['success' => 'Book has been created for the user']);
            }
        else
            {
                return response()->json(['error' => 'Book is already set for this user']);
            }
        

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try {

            if (!$user = JWTAuth::toUser($request->token)) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (TokenExpiredException $e) {

            
            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }
        $token = $request->input('token');
        
        //var_dump($token);
        //$user = JWTAuth::toUser($token);

        $targetBook = book::where(['user_id' => $user->id, 'isbn' => $request->isbn])->first();
        if ($targetBook != null)
            {
                $targetBook->forceDelete();
                return response()->json(['success' => 'The book has been deleted']);
            }
        else
            {
                return response()->json(['error' => 'The book does not exist']);
            }
        //
    }
}
