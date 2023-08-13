<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->all();

        $images = $data['images'];
        unset($data['images']);

        $post = Post::firstOrCreate($data);

        foreach ($images as $image) {
            $name = md5(Carbon::now() . '_' . $image->getClientOriginalName() . '.' . $image->getClientOriginalExtension());
            $preview_name = 'prev_'.$name;
            $path = Storage::disk('public')->putFileAs('/images', $image, $name);

            Image::create([
               'path'=> $path,
                'url' => url('/storage/'.$path),
                'preview_url' => url('/storage/images/'.$preview_name),
                'post_id' => $post->id
            ]);

            \Intervention\Image\Facades\Image::make($image)->fit(100, 100)->save(storage_path('app/public/images/'
                .$preview_name));

        }

        return response()->json(['status'=> 'success']);
    }
}
