<?php
namespace App\Helpers\Media\Src;


use App\Helpers\Media\Models\Media;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Collection;

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
trait MediaInitialization {

    use RemoveMedia;

    protected ?string $uploadMainPath = null;
    protected ?string $urlMainPath = null;
    protected array $groups = [];


    public function __construct()
    {

        $mediaGroup = $this->setGroups();
        foreach ($mediaGroup->getAllGroups() as $group){
            $this->groups[$group->getName()] = ["path" => trim($group->getSavingPath(), DS), "type" => $group->getType()];
        }
        $this->uploadMainPath = "uploads" . DS . trim($this->setMainDirectoryPath(),  DS);
        $this->urlMainPath = trim(str_replace("\\", "/", $this->uploadMainPath), "/");
        unset($mediaGroup);
    }

    public function setGroups() : MediaGroups{
        return (new MediaGroups())
            ->setGroup("single", "default",DS);
    }

    protected function upload($file, $directoryPath): string
    {
        $imageName = time() . rand(0,100000000000) * 35 . "." . $file->getClientOriginalExtension();
        $file->move($directoryPath, $imageName);
        return $imageName;
    }

    public function files(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Media::class, 'mediaable', 'media_type', 'type_id');
    }

    public function getMedia($group = "default")
    {
        if(!isset($this->groups[$group]))
            throw new \Exception("the group is not found or the initialize it is incomplete.");

        if($this->groups[$group]["type"] === 1)
            return $this->files()->where("group", $group)->first();
        else
            return $this->files()->where("group", $group)->get();
    }

    /**
     * @throws \Exception
     */
    public function getFirstMedia($group = "main"){
        if(!isset($this->groups[$group]))
            throw new \Exception("the group is not found or the initialize it is incomplete.");

        return $this->files()->where("group", $group)->first();
    }

    /**
     * Store the uploaded file on a filesystem disk.
     *
     * @param \Illuminate\Http\UploadedFile $path
     * @throws \Exception
     */
    protected function initializeMedia($file, $group): Media
    {
        $groupPath = trim($this->groups[$group]["path"], DS);
        $uploadPath = $this->uploadMainPath . DS .  $this->id . ($groupPath ? DS . $groupPath : '') ;
        $media = new Media();
        $filename = $this->upload($file, $uploadPath);
        $media->filename = $filename;
        $media->group = $group;
        $media->path = $this->urlMainPath. '/' . $this->id . ($groupPath ? '/' . $groupPath : '');
        return $media;
    }

    /**
     * Store the uploaded file on a filesystem disk.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @throws \Exception
     */
    public function saveMedia(\Illuminate\Http\UploadedFile $file, $group = "default"): bool
    {
        if(!isset($this->groups[$group]))
            throw new \Exception("the group is not found or the initialize it is incomplete.");
        $media = $this->initializeMedia($file, $group);
        $this->files()->save($media);
        return true;
    }

    /**
     * @throws \Exception
     */
    public function saveMultiMedia(Collection $files, $group = "default"): bool
    {
        if(!isset($this->groups[$group]))
            throw new \Exception("the group is not found or the initialize it is incomplete.");
        if($this->groups[$group]["type"] !== 2)
            throw new \Exception("the group is not support multi media.");
        foreach ($files as $file){
            $media = $this->initializeMedia($file, $group);
            $this->files()->save($media);
        }
        return true;
    }

}
