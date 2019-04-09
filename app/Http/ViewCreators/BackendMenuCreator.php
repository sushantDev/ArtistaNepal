<?php

namespace App\Http\ViewCreators;

use Illuminate\View\View;

class BackendMenuCreator
{

    /**
     * The user model.
     *
     * @var \App\User;
     */
    protected $user;

    /**
     * Create a new menu bar composer.
     */
    public function __construct()
    {
        $this->user = auth()->user();
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function create(View $view)
    {
        $menu[] = [
            'class' => false,
            'route' => url('/admin/home'),
            'icon'  => 'md md-home',
            'title' => 'Home'
        ];
        /*
         * Sample for adding menu
         * array_push($menu,
            [
                'class' => {desired class},
                'route' => {desired route or url},
                'icon'  => {md or fa icon class},
                'title' => {title},
                \\Optional Sub Menu Items
                'items' => [
                    ['route' => {route or url}, 'title' => {title}],
                    ...
                ]
            ]);
         */

        if (auth()->user()->hasRole('admin')) {
            array_push($menu, [
                'class' => false,
                'route' => route('user.index'),
                'icon'  => 'md md-accessibility',
                'title' => 'Users'
            ]);

            array_push($menu, [
                'class' => false,
                'route' => route('post.index'),
                'icon'  => 'md md-web',
                'title' => 'Posts'
            ]);

            array_push($menu, [
                'class' => false,
                'route' => route('event.index'),
                'icon'  => 'md md-event',
                'title' => 'Schedule'
            ]);

            array_push($menu, [
                'class' => false,
                'route' => route('contact.index'),
                'icon'  => 'md md-email',
                'title' => 'Email'
            ]);
        }

        if (auth()->user()->hasRole('artist')) {
            array_push($menu, [
                'class' => false,
                'route' => route('post.index'),
                'icon'  => 'md md-web',
                'title' => 'Posts'
            ]);

            array_push($menu, [
                'class' => false,
                'route' => route('event.index'),
                'icon'  => 'md md-event',
                'title' => 'Schedule'
            ]);
        }

        if (auth()->user()->hasRole('organiser')) {
            array_push($menu, [
                'class' => false,
                'route' => route('post.index'),
                'icon'  => 'md md-web',
                'title' => 'Posts'
            ]);

            array_push($menu, [
                'class' => false,
                'route' => route('event.index'),
                'icon'  => 'md md-event',
                'title' => 'Schedule'
            ]);
        }

        if (auth()->user()->hasRole('user')) {
            //
        }

        $view->with('allMenu', $menu);
    }
}