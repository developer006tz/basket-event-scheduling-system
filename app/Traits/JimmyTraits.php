<?php 
namespace App\Traits;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


trait JimmyTraits{

    public function upload_file($file, $filename = null, $subfolder = null)
    {
        $filename = $filename ? $filename : time() . '.' . $file->extension();

        $path = $subfolder ? public_path('uploads/' . $subfolder . '/') : public_path('uploads/');
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true);
        }
        $file->move($path, $filename);

        return 'uploads/' . $subfolder . '/'.$filename;
    }

    public function delete_file($file_path)
{
    if (File::exists(public_path('uploads/' . $file_path))) {
        File::delete(public_path('uploads/' . $file_path));
    }
}

}