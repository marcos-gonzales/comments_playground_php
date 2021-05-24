<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function postComment(Request $req) {
      $comment = Post::find(1);


      $req->validate([
        'comment' => 'required'
      ]);


      $comment->comments()->create([
        'comment' => $req->comment,
        'comment_id' => auth()->user()->getOriginal('id'),
        'post_id' => $req->post_id
      ]);

      return redirect()->back();
    }
}
