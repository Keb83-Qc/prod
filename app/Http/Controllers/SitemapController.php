<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SitemapController extends Controller
{
    public function index()
    {
        $members = DB::table('users')->whereNotNull('slug')->get();
        // $posts = DB::table('blog_posts')->get(); // Si vous voulez le blog aussi

        return response()->view('sitemap', [
            'members' => $members,
            // 'posts' => $posts
        ])->header('Content-Type', 'text/xml');
    }
}
