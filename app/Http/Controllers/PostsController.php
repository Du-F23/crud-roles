<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PostsController extends Controller
{
    // usa los permisos de laravel para verificar si el usuario esta logeado y tiene los permisos de crear, editar y eliminar un post
    public function __construct()
    {
        $this->middleware('permission:create posts')->only('store');
        $this->middleware('permission:edit posts')->only('update');
        $this->middleware('permission:delete posts')->only('destroy');
    }

    public function index(): View
    {
        //Verifica el rol que tiene mi usuario logeado usando la libreia de laravel permissions
        if (Auth::user()->hasRole('Administrador')) {
            $posts = Posts::all();
        } else {
            $posts = Posts::where('author_id', Auth::user()->id)->get();
        }

        return view('dashboard', compact('posts'));
    }

    public function store(Request $request): RedirectResponse
    {
//        dd($request->all());
        $request->validate([
           'title' => ['string', 'min:3'],
           'body' => ['min:3']
        ]);


        Posts::create([
            'title' => $request->title,
            'body' => $request->body,
            'author_id' => Auth::user()->id,
        ]);

        return redirect()->route('dashboard');
    }

    public function show($id): View
    {
        $post=Posts::find($id);

        return view('posts.show', compact('post'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'title' => ['string', 'min:3'],
            'body' => ['min:3']
        ]);

        $post=Posts::find($id);

        $post->update($request->all());

        return redirect()->route('posts.show', $post->id);
    }

    public function destroy($id): RedirectResponse
    {
        $post=Posts::find($id);
        $post->delete();

        return redirect()->route('dashboard');
    }
}
