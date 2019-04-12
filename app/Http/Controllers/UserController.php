<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\StoreContact;
use App\Http\Requests\StoreUser;
use App\Notifications\ContactReceived;
use App\Notifications\ContactSubmitted;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateUser;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();

        return view('backend.user.index', compact('users'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->map(function ($item) {
            return strtoupper($item);
        });

        return view('backend.user.create', compact('roles'));
    }

    /**
     * @param StoreUser $request
     * @return mixed
     */
    public function store(StoreUser $request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->data();

            $user = User::create($data);

            $this->uploadRequestImage($request, $user);

            $user->assignRole($request->get('role'));
        });

        return redirect()->route('user.index')->withSuccess(trans('messages.create_success', [ 'entity' => 'User' ]));
    }

    public function show(User $user)
    {
        $posts = Post::where('user_id', Auth::id())->latest()->get();

        return view('backend.user.show', compact('user', 'posts'));
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name')->map(function ($item) {
            return strtoupper($item);
        });

        return view('backend.user.edit', compact('user', 'roles'));
    }

    public function update(UpdateUser $request, User $user)
    {
        DB::transaction(function () use ($request, $user) {
            $data = $request->data();

            $user->update($data);

            if (array_key_exists('role', $data)) {
                $user->roles()->sync([ $data['role'] ]);
            }

            $this->uploadRequestImage($request, $user);

            $user->removeRole($user->roles->first()->name);
            $user->assignRole($request->get('role'));
        });

        return redirect()
            ->route('user.index')
            ->with('success', trans('messages.update_success', [ 'entity' => 'User' ]));
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->withSuccess(trans('message.delete_success', [ 'entity' => 'User' ]));
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function follow(User $user)
    {
        auth()->user()->follow($user);

        return redirect()
            ->back()
            ->withSuccess(trans('message.follow_success', [ 'entity' => 'User' ]));
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function unFollow(User $user)
    {
        auth()->user()->unfollow($user);

        return redirect()
            ->back()
            ->withSuccess(trans('message.un_follow_success', [ 'entity' => 'User' ]));
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact(User $user)
    {
        return view('backend.user.email', compact('user'));
    }

    public function notify(StoreContact $request)
    {
        $name    = Auth::user()->name;
        $email = $request->get('email');
        $message = $request->get('message');

        DB::transaction(function () use ($request) {
            Contact::create($request->data());
        });

        Notification::route('mail', $email)->notify(new ContactSubmitted($name, $email, $message));

        return redirect()->back()->withSuccess('Congrats!! You have successfully sent your message.');
    }
}
