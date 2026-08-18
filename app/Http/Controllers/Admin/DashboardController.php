<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Portfolio;
use App\Models\Article;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'messages_unread'   => Message::unread()->count(),
            'messages_total'    => Message::count(),
            'portfolios_total'  => Portfolio::count(),
            'services_total'    => Service::count(),
            'articles_total'    => Article::count(),
            'articles_published'=> Article::where('is_published', true)->count(),
        ];

        $latest_messages = Message::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latest_messages'));
    }
}
