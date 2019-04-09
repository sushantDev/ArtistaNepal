<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

  /**
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function index()
  {
    $settings = Setting::all();

    return view('backend.setting.index', compact('settings'));
  }

  /**
   * @param Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update(Request $request)
  {
    foreach ($request->get('setting') as $slug => $value) {
      $setting = Setting::firstOrCreate([
        'slug' => $slug
      ]);

      if ($request->hasFile($slug)) {
        $imageDetails = [
          'name' => $request->{$slug}->getClientOriginalName(),
          'size' => $request->{$slug}->getSize(),
          'path' => request()->{$slug}->store(null, 'public')
        ];

        if ($setting->image) {
          $setting->image->deleteImage();
          $setting->image->update($imageDetails);
        } else {
          $setting->image()->create($imageDetails);
        }

        $value = $imageDetails['path'];
      }

      if ($setting) {
        $setting->update([ 'value' => $value ]);
      }
    }

    return redirect()->back()->with('success', trans('messages.update_success', [ 'entity' => 'Setting' ]));
  }
}