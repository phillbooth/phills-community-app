<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public $userId;

    public function __construct()
    {
        if (Auth::check()){
        $this->userId =  Auth::user()->id;
        }else{
            
        log::error("-------------------------------------");
        log::error(Auth::check());
        log::error(Auth::id());
        }
    }
    // This method remains largely unchanged, but now returns JSON
    public function index()
    {
        $articles = Article::latest()->get();
        return response()->json($articles);
    }

    public function show(Article $article)
    {
        // Eager load comments with the article. Order comments as needed, for example, newest first.
        $article->load(['comments' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }]);
        return Inertia::render('ArticleShow', ['article' => $article]);
    }


    // The store method needs to be updated to handle API requests
    public function store(Request $request)
    {
        if($this->userId ===null){
            return "please login";
        }
            // Wrap everything in a try-catch block
            try {
                // Validate the incoming request data
                $validated = $request->validate([
                    'title' => 'required|string|max:255',
                    'description' => 'required|string',
                    // Removed 'user_id' since it's fetched from authenticated user
                ]);
                
                // Assuming you are using Laravel's authentication
                
                Log::error("xxx: " . $this->userId );
                
                // Create and save the article
                $article = new Article();
                $article->title = $validated['title'];
                $article->description = $validated['description'];
                $article->user_id = $this->userId; // Assign the user ID from the authenticated user

                if($article->save()){
                    
                    // Respond with success and include article ID for redirection
                    return redirect()->route('articles.show', $article->id)
                    ->with(['message' => 'Article created successfully!']);

                   
                }
            } catch (\Illuminate\Validation\ValidationException $e) {
                // Catch validation exceptions and return the response
                return response()->json(['errors' => $e->errors()], 422);
            } catch (\Exception $e) {
                // Catch other exceptions and return a generic error message
                // Ensure to log the error message for server side monitoring
                \Log::error($e->getMessage());
                return response()->json(['error' => 'An error occurred, please try again or contact support if the problem persists.'], $e->getCode() ? $e->getCode() : 500);
            }
      
        
    }
    
    
    
}
