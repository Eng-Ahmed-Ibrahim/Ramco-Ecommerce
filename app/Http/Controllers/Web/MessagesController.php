<?php

namespace App\Http\Controllers\Web;

use App\Models\Message;
use App\Helpers\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessagesController extends Controller
{
    public function index()
    {
        $branches=Helpers::get_branches();
        return view('web.contact.index',compact('branches'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'              => 'required|email|max:255',
            'country'            => 'required|string|max:255',
            'message'        => 'required|string',
        ]);
        Message::create($validated);
        return redirect()->back()->with('success', 'Your message sent successfully!');
    }
}
