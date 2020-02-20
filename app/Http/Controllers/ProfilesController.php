<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Prefecture;
use App\Post;

class ProfilesController extends Controller
{

    public function show(User $user) {
      $num = 0;
      $num_hokkaido = 0;
      $num_tohoku = 0;
      $num_kanto = 0;
      $num_chubu = 0;
      $num_kinki = 0;
      $num_chugoku = 0;
      $num_shikoku = 0;
      $num_kyushu = 0;
      $japan_late = 0;
      $hokkaido_late = 0;
      $tohoku_late = 0;
      $kanto_late = 0;
      $chubu_late = 0;
      $kinki_late = 0;
      $chugoku_late = 0;
      $shikoku_late = 0;
      $kyushu_late = 0;
      $photos = [];
      $pre_data = [];
      $havebeen = 0;

      for($i = 1; $i < 48; $i++){
        $photos[] = Prefecture::find($i)->posts->where('user_id', $user->id)->count();

        if($user->posts->where('prefecture_id', $i)->count() > 0){
          $pre_data[] = 1;
          $havebeen += 1;
          $num += 100/47;

          if($i == 1){
            $num_hokkaido += 100;
          }elseif($i<8){
            $num_tohoku += 100/6;
          }elseif($i<15){
            $num_kanto += 100/7;
          }elseif($i<24){
            $num_chubu += 100/9;
          }elseif($i<31){
            $num_kinki += 100/7;
          }elseif($i<36){
            $num_chugoku += 100/5;
          }elseif($i<40){
            $num_shikoku += 100/4;
          }elseif($i<48){
            $num_kyushu += 100/8;
          }

        }else{
          $pre_data[] = 0;
        }

      }

      $japan_late = round($num, 1);
      $hokkaido_late = round($num_hokkaido, 1);
      $tohoku_late = round($num_tohoku, 1);
      $kanto_late = round($num_kanto, 1);
      $chubu_late = round($num_chubu, 1);
      $kinki_late = round($num_kinki, 1);
      $chugoku_late = round($num_chugoku, 1);
      $shikoku_late = round($num_shikoku, 1);
      $kyushu_late = round($num_kyushu, 1);

      $photos = json_encode($photos);
      $pre_data = json_encode($pre_data);
      $stars = 0;
      $fans = 0;

      foreach($user->posts as $post){
        $stars += $post->gottenStars->count();
      }

      foreach($user->albums as $album){
        $fans += $album->subscribers->count();
      }

      return view('profiles.show', compact('user', 'fans', 'stars', 'photos', 'pre_data', 'havebeen', 'japan_late', 'hokkaido_late', 'tohoku_late', 'kanto_late', 'chubu_late', 'kinki_late', 'chugoku_late', 'shikoku_late', 'kyushu_late'));
    }


    public function pref(User $user, Prefecture $prefecture) {
      $posts = $user->posts->where('prefecture_id', $prefecture->id);
      $scenaries = $user->posts->where('prefecture_id', $prefecture->id)->where('category_id', 1);
      $foods = $user->posts->where('prefecture_id', $prefecture->id)->where('category_id', 2);
      $facilities = $user->posts->where('prefecture_id', $prefecture->id)->where('category_id', 3);
      $events = $user->posts->where('prefecture_id', $prefecture->id)->where('category_id', 4);
      return view('profiles.pref', compact('user', 'prefecture', 'posts', 'scenaries', 'foods', 'facilities', 'events'));
    }

    public function stars(User $user) {
      $this->authorize('view', $user->profile);
      $posts = auth()->user()->givenStars->reverse();
      return view('profiles.stars', compact('user', 'posts'));
    }


    public function edit(User $user) {
      $this->authorize('update', $user->profile);
      return view('profiles.edit', compact('user'));
    }


    public function update(User $user) {
      $this->authorize('update', $user->profile);

      $data = request()->validate([
        'description' => 'required|string|max:120',
        'facebook' => 'nullable|url',
        'instagram' => 'nullable|url',
        'twitter' => 'nullable|url',
      ]);

      $data2 = request()->validate([
        'traveller_name' => 'required|string|max:30',
        'image' => 'image',
      ]);

      if(request('image')){
        $imagePath = request('image')->store('profile', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
        $image->save();
        $imageArray = ['image' => $imagePath];
        if($user->image !== 'pre_profile_image/SizBONBQJhQ6VjTnulHGXG3pGavd4ZSzAVf6mv4v.png'){
          Storage::disk('public')->delete($user->image);
        }
      }

      auth()->user()->profile->update(array_merge($data));

      auth()->user()->update(array_merge(
        $data2,
        $imageArray ?? []
      ));

      return redirect('/profile/'.$user->id);
    }


}
