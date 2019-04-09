<?php

use App\Image;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

/**
 * @param $value
 * @param string $dash
 * @return string
 */
function display($value, $dash = '-')
{
    if (empty($value)) {
        return $dash;
    }

    return $value;
}

function user_avatar($width, $username = null)
{
    if ($username) {
        $user = \App\Models\User::whereUsername($username)->first();
    } else {
        $user = auth()->user();
    }

    if ($image = $user->image) {
        return asset($image->thumbnail($width, $width));
    } else {
        return asset('img/avatar.png');
    }
}

/**
 * @param $width
 * @param null $entity
 * @return mixed
 */
function thumbnail($width, $height = null, $entity = null)
{
    $height ?: $height = $width;

    if ( ! is_null($entity)) {
        if ($image = $entity->image) {
            return asset($image->thumbnail($width, $height));
        }
    }

    return asset(setting('placeholder'));
}

/**
 * @param $query
 * @return mixed
 */
function setting($query)
{
    $setting = \App\Setting::fetch($query)->first();

    return $setting ? $setting->value : null;
}

if ( ! function_exists('file_upload')) {
    function file_upload(UploadedFile $file, Model $model, $single = true, $slug = null)
    {
        $extension = $file->getClientOriginalExtension();
        $filename  = $file->getClientOriginalName();
        $data      = [
            'name' => $filename,
            'size' => $file->getClientSize(),
            'path' => $file->storeAs(strtolower(str_plural(class_basename($model))), str_random() . '.' . $extension, 'public'),
            'slug' => $slug
        ];

        if ($single) {
            if ($model->files) {
                $model->files()->delete();
            }

            $model->files()->create($data);
        } else {
            $model->files()->create($data);
        }
    }
}
if ( ! function_exists('find_file_type')) {
    function find_file_type($files)
    {
        $file = $files->pluck('path');
        if (isset($file[0])) {
            $new_file = asset('storage/' . $file[0]);

            return GuzzleHttp\Psr7\mimetype_from_filename($new_file);
        }

        return null;
    }
}
if ( ! function_exists('get_file')) {
    function get_file($files)
    {
        $file = $files->pluck('path');
        if (isset($file[0])) {
            $new_file = asset('storage/' . $file[0]);

            return $new_file;
        }

        return null;
    }
}
