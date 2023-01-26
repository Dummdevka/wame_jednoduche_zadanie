<?php

namespace App\Http\Traits;

trait ImageTrait {
    public function upload_image($model, $file, $entity, $dir = 'app/public/temps', ) {
        $save_dir = storage_path($dir);
        $extension = $file->getClientOriginalExtension();
        $filename = $entity . '-' . $model->id . '-'. time() . '.' . $extension;

        $result_path = $save_dir . '/' . $filename;
        $file->move(storage_path('app/public/temps/') , $filename);
        $this->clear_cache($model);
        
        $model->addMedia($result_path)->toMediaCollection('images', $entity);
        
    // return $result_path;
    }

    public function clear_cache($model) {
        $media_items = $model->getMedia('images');
        // dd($media_items);
        foreach($media_items as $item) {
            $item->forceDelete();
        }
        // rmdir(storage_path('app/public/temps'));
        return true;
    }
}