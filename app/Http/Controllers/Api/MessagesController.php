<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessagesRequest;
use App\Http\Resources\MessagesResourse;
use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Label;
use App\Models\ContactMessage;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return MessagesResourse::collection(ContactMessage::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return MessagesResourse
     */
    public function store(MessagesRequest $request)
    {
        $task=ContactMessage::create($request->validated());

        return new MessagesResourse($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return MessagesResourse
     */
    public function show($id)
    {
        return new MessagesResourse(ContactMessage::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return MessagesResourse
     */
    public function update(MessagesRequest $request,$id)
    {
        ContactMessage::find($id)->update($request->validated());
        return new MessagesResourse(ContactMessage::find($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return MessagesResourse
     */
    public function destroy($id)
    {
        $task = ContactMessage::find($id);
        $task->delete();
        return new MessagesResourse($task);
    }
}
