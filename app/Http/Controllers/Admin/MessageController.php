<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->paginate(20);
        $unread   = Message::unread()->count();

        return view('admin.messages.index', compact('messages', 'unread'));
    }

    public function show(Message $message)
    {
        // Otomatis tandai sebagai sudah dibaca
        if (! $message->is_read) {
            $message->markAsRead();
        }

        return view('admin.messages.show', compact('message'));
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('admin.messages.index')
                         ->with('success', 'Pesan berhasil dihapus.');
    }
}
