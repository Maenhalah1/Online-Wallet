<?php

namespace App\Helpers\Media\Src;

use Illuminate\Support\Facades\File;

trait RemoveMedia
{

    public function removeMedia($media){
        if($media instanceof \Illuminate\Database\Eloquent\Collection){
            foreach ($media as $file){
                File::delete($file->path . config("global.ds") . $file->filename);
                $file->delete();
            }
        }else{
            File::delete($media->path . config("global.ds") . $media->filename);
            $media->delete();
        }
    }

    public function removeAllMedia() : bool{
        if($this->files){
            if($this->files instanceof \Illuminate\Database\Eloquent\Collection){
                foreach ($this->files as $file)
                    $file->delete();
            }else
                $this->files->delete();

            return $this->removeDir($this->setMainDirectoryPath() . config("global.ds") . $this->id);
        }
        return false;
    }

    public function removeGroupMedia($group) : bool{
        $files = $this->files($this->groups[$group]["type"])->where("group", $group)->get();
        if($files->isNotEmpty()){
            if($files instanceof \Illuminate\Database\Eloquent\Collection){
                foreach ($files as $file)
                    $file->delete();
            }else
                $this->files->delete();

            return $this->removeDir($this->setMainDirectoryPath() . config("global.ds") . $this->id . DS . $this->groups[$group]["path"]);
        }
        return false;
    }

    protected function removeDir($path){
        if(is_dir($path)){
            $files = glob($path . "*" , GLOB_MARK);
            foreach($files as $file){
                $this->removeDir($file);
            }
            if(is_dir($path))
                rmdir($path);
        }elseif(is_file($path)){
            unlink($path);
        }
        return true;
    }

}
