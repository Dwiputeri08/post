<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\{
    Post,
    Comment

};   
use Illuminate\view\view;
use Storage;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::latest()->paginate(5);

        return view('post.index', compact('post'));
    }
    
    public function create()
       { 
    
        return view('post.create');
    }
    public function store(Request $request)
    {
    
        $this->validate($request, [
            'image' =>'required|image|mimes:png,jpeg,jpg|max:2048',
            'title'=>'required',
            'content'=>'required'
        ]);
    
    $image = $request->file('image');
    $image->storeAs('public/post',$image->hashName());

    Post::create([
        'image'=>$image->hashName(),
        'title'=>$request->title,
        'content'=>$request->content
    ]);
    return redirect('/posts')
        ->with(['success'=>'Data berhasil diseimpan']);

    }
    
    public function edit($id)
    {
        $post=Post::findOrFail($id);
        return view('post.edit', compact('post'));
    }
    public function update(Request $request, $id)
    {
        $post=Post::findOrFail($id);
        $this->validate($request, [
            'image' =>'required|image|mimes:png,jpeg,jpg|max:2048',
            'title'=>'required',
            'content'=>'required'
        ]);

        if(!$request->hasFile ('image')){
            $request->image =$post->image;

              $post->update([
            'title'=>$request->title,
            'image'=>$request->image,
            'content'=>$request->content
              ]);

        }else{
            $image=$request->file('image');
            $image->storeAs('public/post',$image->hashName());
            Storage::delete('public/posts/'.$post->image);

            $post->update([
            'title'=>$request->title,
            'image'=>$image->hashName(),
            'content'=>$request->content
              ]);
                }
          return redirect('/posts')
                ->with(['success' => 'Data berhasil diubah']);
        }
        public function show ($id)        
        {
            $post=Post::findOrFail($id);
            $comment = Comment:: where('post_id',$post->id)->get();

             return view('post.show', compact('post', 'comment'));
        }  
        public function delete ($id) 
        {
            $post=Post::findOrFail($id);
             $post->delete();

            return redirect('/posts')
                ->with(['success' => 'Data berhasil dihapus']);
        }

    }

