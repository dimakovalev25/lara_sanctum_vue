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
            $path = Storage::disk('public')->putFileAs('/images', $image, $name);

            Image::create([
               'path'=> $path,
                'url' => url('/storage/'.$path),
                'post_id' => $post->id
            ]);

        }

        return response()->json(['status'=> 'success']);
    }
}
