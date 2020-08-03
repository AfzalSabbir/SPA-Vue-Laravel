<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->posts()
            ->orderBy('title')
            ->filter(Request::only('search', 'trashed'))
            ->paginate()
            ->only('id', 'title', 'body', 'deleted_at');

        $return = Inertia::render('Posts/Index', [
            'filters' => Request::all('search', 'trashed'),
            'posts' => $posts
        ]);
        return $return;
    }

    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    public function store()
    {
        $post = Request::validate([
            'title' => ['required', 'max:191'],
            'body'  => ['required']
        ]);
        $post['user_id'] = Auth::user()->id;
        $post['slug']    = \Str::slug(request()->title);

        Post::create($post);

        return Redirect::route('posts')->with('success', 'Post created.');
    }

    public function edit(Post $post)
    {
        return Inertia::render('Posts/Edit', [
            'organization' => [
                'id'    => $post->id,
                'title' => $post->title,
                'body'  => $post->body
            ],
        ]);
    }

    public function update(Organization $organization)
    {
        $organization->update(
            Request::validate([
                'name' => ['required', 'max:100'],
                'email' => ['nullable', 'max:50', 'email'],
                'phone' => ['nullable', 'max:50'],
                'address' => ['nullable', 'max:150'],
                'city' => ['nullable', 'max:50'],
                'region' => ['nullable', 'max:50'],
                'country' => ['nullable', 'max:2'],
                'postal_code' => ['nullable', 'max:25'],
            ])
        );

        return Redirect::back()->with('success', 'Organization updated.');
    }

    public function destroy(Organization $organization)
    {
        $organization->delete();

        return Redirect::back()->with('success', 'Organization deleted.');
    }

    public function restore(Organization $organization)
    {
        $organization->restore();

        return Redirect::back()->with('success', 'Organization restored.');
    }
}
