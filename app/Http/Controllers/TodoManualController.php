<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\TodoManual;

class TodoManualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $todos = DB::table('todo_manuals')
                ->get();

            return response()->json([
                'message'   => 'Successful! Getting all todos.',
                'todos'     => $todos,
            ]);
        } catch (Exception $e) {
            $status = 400;

            if ($this->isHttpException($e)) $status = $e->getStatusCode();

            return response()->json([
                'message'   => 'Something went wrong.'
            ], $status); 
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
        try {
            $todo = TodoManual::show($id);

            if(!$todo) {
                return response()->json([
                    'message'   => "Todo doesn't exist.",
                ], 404);
            }
    
            return response()->json([
                'message'   => 'Successful! Getting todo.',
                'todo'      => $todo,
            ]);
        } catch (Exception $e) {
            $status = 400;

            if ($this->isHttpException($e)) $status = $e->getStatusCode();

            return response()->json([
                'message'   => 'Something went wrong.'
            ], $status); 
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $todo_id = DB::table('todo_manuals')
                ->insertGetId([
                    'title'         =>  $request->title,
                    'description'   =>  $request->description,
                ]);
                    
            $todo = TodoManual::show($todo_id);
    
            return response()->json([
                'message'   => 'Successful! Creating todo.',
                'todo'      => $todo,
            ]);
        } catch (Exception $e) {
            $status = 400;

            if ($this->isHttpException($e)) $status = $e->getStatusCode();

            return response()->json([
                'message'   => 'Something went wrong.'
            ], $status); 
        }
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
        try {
            $todo = DB::table('todo_manuals')
                ->where('id', $id)
                ->update([
                    'title'         =>  $request->title,
                    'description'   =>  $request->description,
                ]);
                    
            $todo = TodoManual::show($id);

            return response()->json([
                'message'   => 'Successful! Updating todo.',
                'todo'      => $todo,
            ]);
        } catch (Exception $e) {
            $status = 400;

            if ($this->isHttpException($e)) $status = $e->getStatusCode();

            return response()->json([
                'message'   => 'Something went wrong.'
            ], $status); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $todo = DB::table('todo_manuals')
                ->where('id', $id)
                ->delete();
    
            return response()->json([
                'message'   => 'Successful! Deleting todo.',
            ]);
        } catch (Exception $e) {
            $status = 400;

            if ($this->isHttpException($e)) $status = $e->getStatusCode();

            return response()->json([
                'message'   => 'Something went wrong.'
            ], $status); 
        }
    }
}
