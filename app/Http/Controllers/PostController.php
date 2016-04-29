<?php

namespace App\Http\Controllers;

use Auth;
use File;
use App\Tag;
use App\Post;
use App\Picture;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;


class PostController extends Controller
{

    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $paginate = 10;

    public function index()
    {
        $title = 'Post';
        $posts = Post::with('category', 'user')->paginate($this->paginate);

        return view('admin.post.index', compact('posts', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::lists('title', 'id');
        $tags = Tag::lists('name', 'id');
        $user_id = Auth::user()->id;
        return view('admin.post.create', compact('categories', 'tags', 'user_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->all());

        if (!empty($request->input('tag_id')))
            $post->tags()->attach($request->input('tag_id'));

        $im = $request->file('picture');
        if (!empty($im)) {
            $this->upload($im, $request->input('name'), $post->id);
        }

        return redirect('post')->with(['message' => sprintf('Votre article a bien été enregistré !')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::lists('title', 'id');
        $post = Post::findOrFail($id);
        $tags = Tag::lists('name', 'id');
        $user_id = Auth::user()->id;
        return view('admin.post.edit', compact('post', 'categories', 'tags', 'user_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());

        $tags = (empty($request->input('tag_id'))) ? [] : $request->input('tag_id');
        $post->tags()->sync($tags);

        if ($request->input('suppr')) {
            $this->deletePicture($post);
        }

        $im = $request->file('picture');
        if (!is_null($im)) {
            $this->deletePicture($post);
            $this->upload($im, $request->input('name'), $post->id);
        } else {
            if ($post->picture)
                $post->picture->update($request->all());
        }

        return redirect('post')->with(['message' => sprintf('Votre article a bien été modifié.')]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $title = $post->title;
        $this->deletePicture($post);
        $post->delete();

        return redirect('post')->with(['message' => sprintf('L\'article "%s" a bien été supprimé.' , $title)]);
    }


    /**
     * upload method
     *
     * @param $im
     * @param $postId
     * @return bool
     */
    private function upload($im, $name, $postId)
    {
        $ext = $im->getClientOriginalExtension();
        $uri = str_random(30) . '.' . $ext;
        Picture::create([
            'name' => $name,
            'uri' => $uri,
            'size' => $im->getSize(),
            'mime' => $im->getClientMimeType(),
            'post_id' => $postId
        ]);
        $im->move(env('UPLOAD_PICTURES', 'uploads'), $uri);

        return true;
    }

    /**
     * @param Post $p
     * @return bool
     */
    private function deletePicture(Post $p)
    {
        if (!is_null($p->picture)) {
            $fileName = public_path('uploads') . DIRECTORY_SEPARATOR . $p->picture->uri;

            if (File::exists($fileName))
                File::delete($fileName);

            $p->picture->delete();

            return true;
        }
        return false;
    }

    public function changeStatus($id){
        $post = Post::findOrFail($id);
        $status = $post->status=='published' ? 'unpublished':'published';
        $post->status = $status;
        $post->save();

        return redirect('post')->with(['message' => sprintf('Le status a bien été modifier.')]);
    }
}
