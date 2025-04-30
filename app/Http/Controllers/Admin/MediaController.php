<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Property;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Http\Controllers\Controller;
use App\TemporaryUpload;

class MediaController extends Controller
{
    public function upload(Request $request)
    {
        // Temporarily assign media to a dummy model (or no model at all)
        $tempModel = new TemporaryUpload(); // or just any placeholder model
        $tempModel->id = 0;
        $tempModel->exists = true;

        $media = $tempModel
            ->addMediaFromRequest('filepond')
            ->toMediaCollection('temp'); // Use a temp collection

        return response()->json([
            'id' => $media->id,
            'url' => $media->getUrl(),
            'path' => $media->getPath(), // important for revert!
            'name' => $media->name, // important for revert!
            'size' => $media->size, // important for revert!
            'mime' => $media->mime_type, // important for revert!
        ]);
    }

    public function list()
    {
        $media = Media::where('collection_name', 'images')->latest()->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'url' => $item->getUrl('thumb'),
            ];
        });

        return response()->json($media);
    }

    public function delete($id)
    {
        Media::findOrFail($id)->delete();
        return response()->json(['status' => 'deleted']);
    }
}
