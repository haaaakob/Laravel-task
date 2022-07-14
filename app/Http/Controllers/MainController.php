<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\DocBlock\Description;

class MainController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function register()
    {
        return view('registration');
    }

    public function login_check(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|alpha_num|min:5',
        ],
            [
                'email.required' => 'Please enter your email',
                'email.email' => 'Email must be a valid email address',
                'password.required' => 'Please enter the password',
                'password.alpha_num' => 'Password must be alpha numeric chars',
                'password.min' => 'Password should be minimum 6 chars',
            ]);

        $userInfo = User::where('email','=',$request->email)->first();
//        echo '<pre>'.json_encode($userInfo, JSON_PRETTY_PRINT).'</pre>';die();

        if (!$userInfo){
            return back()->with('fail','We do not recognize your email address');
        }else{
            if (Hash::check($request->password, $userInfo->password)){
                if ($userInfo->is_admin == 0){
                    $request->session()->put('loggedUser',$userInfo->id);
                    return redirect('private');
                }else{
                    $request->session()->put('loggedUser',$userInfo->id);
                    return redirect('admin');
                }

            }else{
                return back()->with('fail','Incorrect password');
            }
        }
//        dd($request->all());
    }

    public function regProcess(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:20',
            'surname' => 'required|string|min:3|max:25',
            'email' => 'required|email|unique:users',
            'password' => 'required|alpha_num|min:5',
            'confirmPassword' => 'required|same:password',
        ],
            [
                'name.required' => 'Please enter your name',
                'name.max' => 'Name must not be more than 20 chars',
                'surname.required' => 'Please enter your surname',
                'surname.max' => 'Surname must not be more than 20 chars',
                'email.required' => 'Please enter your email',
                'email.email' => 'Email must be a valid email address',
                'password.required' => 'Please enter the password',
                'password.alpha_num' => 'Password must be alpha numeric chars',
                'password.min' => 'Password should be minimum 6 chars',
                'confirmPassword.required' => 'Please enter the password',
                'confirmPassword.same' => 'Password must be same',
            ]);

        $user = User::create([
            'name' => $request['name'],
            'surname' => $request['surname'],
            'email' => $request['email'],
            'password' => $request['password'],
        ]);
        if ($user){
//            Auth::login($user);
            return back()->with('success','New User has been successfully added to database');
        } else{
            return back()->with('fail','Something went wrong, try again');
        }
//        dd($request->all());
    }

    public function private()
    {
        $userInfo = ['loggedUser'=>User::where('id','=',session('loggedUser'))->get()];
        $post = ['post'=>Post::with('comments')->paginate(4)];

//        echo '<pre>'.json_encode($userInfo, JSON_PRETTY_PRINT).'</pre>';die();

        return view('private',$userInfo, $post);
    }

    public function admin()
    {
        $userInfo = ['loggedUser'=>User::where('id','=',session('loggedUser'))->get()];
        $post = ['post'=>Post::with('comments')->paginate(4)];

//        echo '<pre>'.json_encode($userInfo, JSON_PRETTY_PRINT).'</pre>';die();

        return view('admin',$userInfo, $post);
    }

    public function pots(Request $request)
    {
        $request->validate([
            'post' => 'required|mimes:jpeg,png,jpg|max:5048',
            'title' => 'required|min:3|max:40',
            'description' => 'required|min:3|max:40',
        ],
            [
                'post.mimes' => 'Sorry you con upload only this type jpeg,png,jpg',
                'post.max'=> 'Sorry your file is to large'
            ]);

        if ($request->hasFile('post')) {
            $posts = $request->file('post');
            $filename = time() . '.' . $posts->getClientOriginalExtension();
            $request->post->move(public_path('images/gallery/'), $filename);
//            dd($filename);
            $createPost = Post::create([
                'user_id' => session('loggedUser'),
                'title' => $request['title'],
                'description' => $request['description'],
                'image' => $filename
            ]);
        }
//        dd($request->all());
        if ($createPost){
            return back()->with('success', 'You have successfully added post in gallery');
        }else{
            return back()->with('fail', 'Something went wrong, try again');
        }
    }

    public function add_comment(Request $request)
    {
        $request->validate([
            'comment' => 'required|min:3|max:20',
        ],
        [
            'comment.max'=> 'Sorry your comment is very big',
            'comment.required' => 'the comment is empty'
        ]);

//        dd(session('loggedUser'));
        $createComment = Comment::create([
            'user_id' => session('loggedUser'),
            'post_id' => $request['postId'],
            'text' => $request['comment']
        ]);

        if ($createComment){
            return back()->with('success');
        }else{
            return back()->with('error');
        }
    }

    public function logout()
    {
        if(session()->has('loggedUser')){
            session()->pull('loggedUser');
            return redirect('login');
        }
    }
}
