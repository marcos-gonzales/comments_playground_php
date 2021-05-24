<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Sentinel;
use App\Models\User;
use App\Models\Comment;


class PostController extends Controller
{
    public function getSinglePost(Request $req) {
      $post_route_id = $req->route('id');
      $post = Post::find($post_route_id);
      $post_owner = User::find($post->post_id);

      $comment = DB::table('users')
      ->join('comments', 'comments.comment_id', '=', 'users.id')
      ->where('comments.post_id', '=', $post_route_id)
      ->get();
      

      return view('post/singlePost', [
        'comments' => $comment,
        'currentPost' => $post,
        'comment_id' => $post_route_id,
        'post_owner' => $post_owner
      ]);
    }

    public function getPosts() {

      $how_many_comments = DB::table('posts')
      ->join('comments', 'comments.comment_id', '=', 'posts.post_id')
      ->where('comments.post_id', '=', 3)
      ->get();

      $posts = Post::All();
      $posts_id = DB::table('comments')->select('post_id')->where('post_id','=', 1)->count();
      $posts_id_3 = DB::table('comments')->select('post_id')->where('post_id','=', 3)->count();
      
      $howMany = DB::table('comments')->select('post_id')->where('post_id', '=', 2)->count();

      $comments = Post::find(1);

      return view('post.posts', [
        'posts' => $posts,
        'comments' => $comments,
        'user' => auth()->user(),
        'howMany' => $howMany,
      ]);
    }

    public function postPosts(Request $req) {
      $req->validate([
        'title' => 'required|min:3',
        'body' => 'required|min:3',
      ]);

      if(!$req->file('file')) {
        $saved_filename = 'noname.jpg';
        $file_extension = 'jpg';
      } else {
        $file_extension = $req->file('file')->getClientOriginalExtension();
        $file_fullname = $req->file('file')->getClientOriginalName();
        $filename = pathinfo($file_fullname, PATHINFO_FILENAME);
        $saved_filename = $filename.'_'.time().'.'.$file_extension;
        $path = $req->file('file')->storeAs('storage/file', $saved_filename);
      }
          
      Post::create([
        'post_id' => auth()->user()->getOriginal('id'),
        'title' => $req->title,
        'body' => $req->body,
        'file_path' => $saved_filename,
        'file_extension' => $file_extension
      ]);

      return redirect()->back();
    }
}
