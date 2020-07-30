<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response()->json([
                'message'   => 'Successful! Getting all todos.',
                'todos'     => Todo::all(),
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
            $todo = Todo::create([
                'title'         =>  $request->title,
                'description'   =>  $request->description,
            ]);
    
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $todo = Todo::find($id);

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        try {
            $todo->update([
                'title'         => $request->title,
                'decription'    => $request->decription,
            ]);

            $todo = Todo::find($todo->id);
    
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
    public function destroy(Todo $todo)
    {
        try {
            $todo->delete();
    
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
