<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class BlogController extends Controller
{
    public function addComment () 
    {
        $data = request()->all();

        // && - и, ||
        if(isset($data['post_id']) && isset($data['author']) && isset($data['description'])) {
            Comment::create($data);
        }

        return back();
    }
}
