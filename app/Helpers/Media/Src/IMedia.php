<?php

namespace App\Helpers\Media\Src;

interface IMedia{

    /**
     * Set Main Directory Path After (uploads) Directory
     */
    public function setMainDirectoryPath() : string;
    public function setGroups();
    public function saveMedia(\Illuminate\Http\UploadedFile  $file, $group);
    public function getFirstMedia();
    public function getMedia($group);
    public function removeMedia($media);
    public function removeAllMedia() : bool;
    public function removeGroupMedia($group) : bool;

}
