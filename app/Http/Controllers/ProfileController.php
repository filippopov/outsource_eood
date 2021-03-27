<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function edit(User $user)
    {
        dd($user);
        return view('profile.edit', ['user' => $user]);
    }
    
    public function update(Article $article)
    {
        // update resource
        
        $validateAtributes = $this->validateAtributes();
        
//        $article = Articles::find($articleId);
//        
//        $article->title = request('title');
//        $article->excerpt = request('excerpt');
//        $article->body = request('body');
//        
//        $article->save();
        
        $article->update($validateAtributes);
        
//        return redirect(route('article.show', $article));
        
        return redirect($article->path());
    }
}
