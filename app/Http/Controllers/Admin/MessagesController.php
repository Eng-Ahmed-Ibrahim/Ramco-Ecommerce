<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessagesController extends Controller
{
    public function index()
    {
        $messages = Message::orderBy("id", "DESC")->paginate(15);
        return view('admin.messages.index', compact('messages'));
    }
    public function show($id)
    {
        $message = Message::findOrFail($id);
        $message->update(['is_read'=>true]);
        return view('admin.messages.show', compact('message'));
    }
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        return back()->with("success", "Deleted Successfully");
    }
}
