<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class postController extends Controller
{
    public function createPost(Request $request)
    {
        $incomingFields = $request->validate([
            'post_title' => 'required',
            'post_content' => ['required', 'max:300']
        ]);

        $incomingFields['post_title'] = strip_tags($incomingFields['post_title']);    // view this as preparedstatement
        $incomingFields['post_content'] = strip_tags($incomingFields['post_content']);
        $incomingFields['userId'] = auth()->id();
        Post::create($incomingFields);  // the only buid-in model lavarel has is for 'user' login,
        // thus we have to create anyother model like 'Post' ourself
        return redirect('/');
    }

    public function post_edit_screen(Post $post)
    {
        // Use auth()->id() to safely compare IDs without crashing if unauthenticated
        if (auth()->id() !== $post->userId) {
            return redirect('/');
        }

        return view('post_edit', ['post' => $post]);

        // the 1st arg is the blade file redirection, in the 2nd arg we're specifying the post we wanna send to the blade file
        // this is very easy and time saving
    }


    public function actual_post_update(Request $request, Post $post)
    {
        if (auth()->id() !== $post->userId) {
            return redirect('/');
        }
        $incomingFields = $request->validate([
            'post_title' => 'required',
            'post_content' => ['required', 'max:300']
        ]);
        $incomingFields['post_title'] = strip_tags($incomingFields['post_title']);    // strip_tags() is meant to prevent XSS (Cross-Site Scripting).
        $incomingFields['post_content'] = strip_tags($incomingFields['post_content']);
        $post->update($incomingFields);
        return redirect('/');
    }

    public function deletePost(Post $post)
    {
        if (auth()->id() === $post->userId) {
            $post->delete();
        }
        return redirect('/');
    }
}
