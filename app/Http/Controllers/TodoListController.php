<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Http\Requests\TodoListRequest;
use App\Http\Resources\TodoListResource;
use Symfony\Component\HttpFoundation\Response;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TodoList::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoListRequest $request)
    {
        return TodoList::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TodoList $todo_list)
    {
        return $todo_list;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TodoListRequest $request, TodoList $todo_list)
    {
        return tap($todo_list)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TodoList $todo_list)
    {
        $todo_list->delete();
        return response()->json(['message' => 'The todo list has been deleted.'], Response::HTTP_NO_CONTENT);
    }
}