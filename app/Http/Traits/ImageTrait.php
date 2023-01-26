<?php

namespace App\Http\Traits;

trait ImageTrait {
    public function upload_image($model, $file, $entity, $dir = 'app/public/temps', ) {
        $save_dir = storage_path($dir);
        $extension = $file->getClientOriginalExtension();
        $filename = $entity . '-' . $model->id . '-'. time() . '.' . $extension;

        $result_path = $save_dir . '/' . $filename;
        $file->move(storage_path('app/public/temps/') , $filename);

        return $result_path;
    }

    public function clear_cache() {
        rmdir(storage_path('app/public/temps'));
        return true;
    }
}