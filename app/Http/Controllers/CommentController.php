<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CommentController extends Controller
{
    /**
     * Store a new comment for an article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
 
    
        public function store(Request $request, Article $article)
        {
            $request->validate([
                'body' => 'required|string',
            ]);
        
            $comment = new Comment();
            $comment->body = $request->body;
            $comment->user_id = Auth::id();
            $comment->article_id = $article->id;
            $comment->save();
        
            return redirect()->route('articles.show', $article->id)->with('message', 'Comment added successfully!');
        }
        
    

    /**
     * Display a listing of the comments for a specific article.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function index(Article $article)
    {
        // Get top-level comments only
       // $comments = $article->comments()->whereNull('parent_id')->with('replies.user')->latest()->get();
       $comments = $article->comments()->whereNull('parent_id')->with(['replies.user', 'user'])->latest()->get();
        return Inertia::render('ArticleShow', [
            'article' => $article,
            'comments' => $comments,
        ]);
    }

    public function storeReply(Request $request, $parentId)
    {
        $request->validate([
            'body' => 'required|string',
        ]);
    
        // Retrieve the parent comment to get the article ID
        $parentComment = Comment::findOrFail($parentId);
    
        $reply = new Comment();
        $reply->body = $request->body;
        $reply->user_id = auth()->id(); // Ensure user is logged in
        $reply->parent_id = $parentId; // Set the parent ID for the reply
        $reply->article_id = $parentComment->article_id; // Set the article ID from the parent comment
        $reply->save();
    
        return back()->with('success', 'Reply posted successfully.');
    }
    
    
}
