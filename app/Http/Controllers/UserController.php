<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use Illuminate\Pagination\LengthAwarePaginator;

use App\User;
use App\Posts;
use Illuminate\Http\Request;
class UserController extends Controller {
  /*
   * Display active posts of a particular user
   *
   * @param int $id
   * @return view
   */


  public function user_posts($username)
  {
    //
    $data['author']=  User::where('username',$username)->first();
    $posts = Posts::where('author_id',$data['author']->id)->where('active',1)->orderBy('created_at','desc')->paginate(5);
    $title = $data['author']->name;
    return view('home')->withPosts($posts)->withTitle($title);
  }
  /*
   * Display all of the posts of a particular user
   *
   * @param Request $request
   * @return view
   */
  public function user_posts_all(Request $request)
  {
    //
    $user = $request->user();
    $posts = Posts::where('author_id',$user->id)->orderBy('created_at','desc')->paginate(5);
    $title = $user->name;
    return view('home')->withPosts($posts)->withTitle($title);
  }


  /*
   * Display draft posts of a currently active user
   *
   * @param Request $request
   * @return view
   */
  public function user_posts_draft(Request $request)
  {
    //
    $user = $request->user();
    $posts = Posts::where('author_id',$user->id)->where('active',0)->orderBy('created_at','desc')->paginate(5);
    $title = $user->name;
    return view('home')->withPosts($posts)->withTitle($title);
  }
  /**
   * profile for user
   */
  public function profile(Request $request, $username)
  {
    $data['user'] = User::where('username',$username)->first();
    if (!$data['user'])
      return redirect('/');
    if ($request -> user() && $data['user'] -> id == $request -> user() -> id) {
      $data['author'] = true;
    } else {
      $data['author'] = null;
    }
    $data['comments_count'] = $data['user'] -> comments -> count();
    $data['posts_count'] = $data['user'] -> posts -> count();
    $data['posts_active_count'] = $data['user'] -> posts -> where('active', '1') -> count();
    $data['posts_draft_count'] = $data['posts_count'] - $data['posts_active_count'];
    $data['latest_posts'] = $data['user'] -> posts -> where('active', '1') -> take(5);
    $data['latest_comments'] = $data['user'] -> comments -> take(5);
    return view('admin.profile', $data);
  }

  // ---------------------------------------------------
  //
  //

  public function index(Request $request)
  {
    //
    if($request->user()->is_admin())
    {
      $users = User::paginate(7);
      $title = "Tampilkan semua user";
      //return $users;
      return view('admin.users.index')->withTitle($title)->withUsers($users);
    }
    else
    {
      return redirect('/')->withErrors('You have not sufficient permissions for see All user');
    }

  }
  // create / add user
  public function create(Request $request)
  {
    // if user can post i.e. user is admin or author
    if($request->user()->is_admin())
    {
      return view('admin.users.create');
    }
    else
    {
      return redirect('/')->withErrors('You have not sufficient permissions for writing post');
    }
  }
  // Store add new user
  public function store(UserFormRequest $request)
  {

    $user = new User();
    $user->name = $request->get('name');
    $user->username = $request->input('username');
    $user->email = $request->get('email');
    $user->role = $request->get('role');
    $user->password = bcrypt($request->get('password'));

    $user->save();
    $message = 'User berhasil ditambahkan';
    return redirect('user/show-all-users')->withMessage($message);

  }
  // delete user
  public function destroy(Request $request, $id)
  {
    //
    $user = User::find($id);
    if($user &&  $request->user()->is_admin())
    {
      $user->delete();
      $data['message'] = 'User berhasil dihapus';
    }
    else
    {
      $data['errors'] = 'Kamu tidak diperkenankan mengakses halaman ini.';
    }
    return redirect('user/show-all-users')->with($data);
  }

  // edit user
  public function edit(Request $request,$id)
  {
    $user = User::where('id',$id)->first();
    if($user &&  $request->user()->is_admin())
      return view('admin.users.edit')->withUser($user);
    return redirect('/')->withErrors('Woi, kamu gak diijinkan masuk halaman tadi.');
  }

  // Update Detail User
  public function update(Request $request)
  {
    //
    $id = $request->input('user_id');
    $user = User::find($id);
    if($user && ($user->id == $request->user()->id || $request->user()->is_admin()))
    {

      $user->name = $request->input('name');
      $user->username = $request->input('username');
      $user->email = $request->input('email');
      $user->role = $request->input('role');

      $user->save();
      $landing = '/user/all';
      $message = 'Data user berhasil di update';
           return redirect($landing)->withMessage($message);
    }
    else
    {
      return redirect('/')->withErrors('Kamu tidak boleh mengakses halaman tadi.');
    }
  }
  public function settings(Request $request)
  {
    $user = User::where('id',$request->user()->id)->first();

    if($user)
      return view('admin.users.settings')->withUser($user);
    return redirect('/')->withErrors('Woi, kamu gak diijinkan masuk halaman tadi.');

  }
}
