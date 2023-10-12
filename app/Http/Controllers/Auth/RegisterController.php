<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/'; //ユーザー登録後はログインページに遷移

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'space'], //required=必須項目 string=文字列か max=文字数の上限 space=空白か
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], //email=メールアドレスとして正しいか unique:users=データベースの項目と重複していないか
            'password' => ['required', 'string', 'min:8', 'confirmed'], //min=文字数の下限 confirmed=password_confirmation項目に同じものが設定されてるか
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), //ハッシュ化
        ]);
    }

    public function register(Request $request) //新規登録処理の中にログイン処理が入っているためです。ログイン処理を行わないように対応
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        //ログイン処理を削除
        //$this->guard()->login($user);

        return $this->registered($request, $user)
                    ?: redirect($this->redirectPath());
    }
}
