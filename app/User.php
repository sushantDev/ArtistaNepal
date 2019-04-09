<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Overtrue\LaravelFollow\Traits\CanFollow;
use Overtrue\LaravelFollow\Traits\CanBeFollowed;

class User extends Authenticatable
{
    use Notifiable, HasRoles, CanFollow, CanBeFollowed;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

  public function getRouteKeyName()
  {
    return 'username';
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\MorphOne
   */
  public function image()
  {
    return $this->morphOne(Image::class, 'imageable');
  }

  /**
   * @param array $options
   * @return bool|null|void
   * @throws \Exception
   */
  public function delete(array $options = [])
  {
    if ($this->image)
    {
      $this->image->delete();
    }

    return parent::delete($options);
  }
}
