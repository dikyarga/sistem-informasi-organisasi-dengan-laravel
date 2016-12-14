<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use App\Posts;
use App\User;
use Redirect;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
       //fetch 5 posts from database which are active and latest
       $posts = Posts::where('active',1)->orderBy('created_at','desc')->paginate(5);
       //page heading
       $title = 'Postingan Terbaru';
       //return home.blade.php template from resources/views folder
       return view('home')->withPosts($posts)->withTitle($title);
     }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create(Request $request)
     {
       // if user can post i.e. user is admin or author
       if($request->user()->can_post())
       {
         return view('posts.create');
       }
       else
       {
         return redirect('/')->withErrors('Kamu belum bisa menulis postingan disini');
       }
     }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request)
    {
      $post = new Posts();
      $post->title = $request->get('title');
      $post->body = $request->get('body');
      $post->slug = str_slug($post->title);
      $post->author_id = $request->user()->id;
      if($request->has('save'))
      {
        $post->active = 0;
        $message = 'Postingan berhasil disimpan';
      }
      else
      {
        $post->active = 1;
        $message = 'Postingan berhasil di publikasikan';
      }
      $post->save();
      return redirect('edit/'.$post->slug)->withMessage($message);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
      $post = Posts::where('slug',$slug)->first();
      if(!$post)
      {
       return redirect('/')->withErrors('Halaman yang kamu minta tidak ditemukan');
      }
      $comments = $post->comments;
      return view('posts.show')->withPost($post)->withComments($comments);
      // atau bisa pakai compact
      // return view('posts.show', compact('post', 'comments'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit(Request $request,$slug)
     {
       $post = Posts::where('slug',$slug)->first();
       if($post && ($request->user()->id == $post->author_id || $request->user()->is_admin()))
         return view('posts.edit')->with('post',$post);
       return redirect('/')->withErrors('Kamu tidak boleh mengakses halaman');
     }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request)
     {
       //
       $post_id = $request->input('post_id');
       $post = Posts::find($post_id);
       if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin()))
       {
         $title = $request->input('title');
         $slug = str_slug($title);
         $duplicate = Posts::where('slug',$slug)->first();
         if($duplicate)
         {
           if($duplicate->id != $post_id)
           {
             return redirect('edit/'.$post->slug)->withErrors('Judul yang sama sudah pernah dibuat.')->withInput();
           }
           else
           {
             $post->slug = $slug;
           }
         }
         $post->title = $title;
         $post->body = $request->input('body');
         if($request->has('save'))
         {
           $post->active = 0;
           $message = 'Postingan berhasil disimpan';
           $landing = 'edit/'.$post->slug;
         }
         else {
           $post->active = 1;
           $message = 'Postingan berhasil di perbaharui';
           $landing = $post->slug;
         }
         $post->save();
              return redirect($landing)->withMessage($message);
       }
       else
       {
         return redirect('/')->withErrors('Kamu tidak boleh mengakses halaman');
       }
     }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy(Request $request, $id)
     {
       //
       $post = Posts::find($id);
       if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin()))
       {
         $post->delete();
         $data['message'] = 'Postingan telah di hapus';
       }
       else
       {
         $data['errors'] = 'Invalid Operation. Kamu tidak boleh mengakses halaman';
       }
       return redirect('/')->with($data);
     }

}
