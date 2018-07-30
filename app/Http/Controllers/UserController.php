<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    //
    public function register()
    {
        return view('user.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'                  => 'required',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);

        $data = [
            'avatar'       => 'images/default-avatar.png',
            'confirm_code' => str_random(48)
        ];
        $user = User::create(array_merge($request->all(), $data));

        $view = 'email.register';
        $subject = '验证邮箱';
        $this->sendTo($view, $subject, $user, $data);

        return redirect('/');
    }

    public function login()
    {
        return view('user.login');
    }

    public function signin(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt([
            'email'        => $request->input('email'),
            'password'     => $request->input('password'),
            'is_confirmed' => 1
        ])) {
            return redirect('/');
        }

        Session::flush('login_error', '密码错误或邮箱没验证');
        return redirect('/user/login')->withInput();

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    /**
     * 验证邮件
     * @param $confirm_code
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirmEmail($confirm_code)
    {
        $user = User::where('confirm_code', $confirm_code)->first();
        if (is_null($user)) {
            return redirect('/');
        }

        $user->is_confirmed = 1;
        $user->confirm_code = str_random(48);
        $user->save();
        return redirect('user/login');

    }

    /**
     * 发送邮件
     * @param $view
     * @param $subject
     * @param $user
     * @param array $data
     */
    public function sendTo($view, $subject, $user, $data = [])
    {
        Mail::send($view, $data, function ($message) use ($user, $subject) {
            $message->to($user->email)->subject($subject);
        });
    }

    public function avatar()
    {
        return view('user.avatar');
    }

    public function changeAvatar(Request $request)
    {
        $file = $request->file('avatar');

        $input = array('image' => $file);
        $rules = array('image' => 'image');
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return Response::json([
                'success' => false,
                'errors'  => $validator->getMessageBag()->toArray()
            ]);
        }
        $destinationPath = 'uploads/';
        $filename = Auth::user()->id . '_' . time() . $file->getClientOriginalName();
        $file->move($destinationPath, $filename);

        //压缩图片
        Image::make($destinationPath . $filename)->fit(200)->save();

        $user = User::find(Auth::user()->id);
        $user->avatar = '/' . $destinationPath . $filename;
        $user->save();

        return Response::json([
            'success' => true,
            'avatar'  => asset($destinationPath . $filename)
        ]);

        return redirect('user/avatar');
    }
}
