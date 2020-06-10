<?php

use Intervention\Image\ImageManagerStatic as Image;

class Photo extends Database
{
    public $link;

    public function __construct()
    {
        $this->link = $this->connect();
    }

    public function addImage($title, $location, $userId, $thumbnail)
    {
        $query = $this->link->prepare("INSERT INTO photos(`title`, `location`, `user_id`, `thumbnail`) VALUES(?,?,?,?)");
        $values = array($title, $location, $userId, $thumbnail);
        $query->execute($values);
        return $query->rowCount();
    }

    public function getImages($userId)
    {
        $query = $this->link->query("SELECT * FROM photos WHERE `user_id`='$userId' ORDER BY `reg_date` DESC");
        return array($query, $query->rowCount());
    }

    public function getSingleImage($id, $user_id)
    {
        $query = $this->link->query("SELECT * FROM photos WHERE `id`='$id' AND `user_id`='$user_id'");
        return array($query, $query->rowCount());
    }

    public function searchImages($term, $user_id)
    {
        $query = $this->link->prepare("SELECT * FROM photos WHERE `user_id`= :user_id AND `title` LIKE :term");
        $query->execute([':user_id' => $user_id, ':term' => '%'.$term.'%']);
        return array($query, $query->rowCount());
    }

    public function updateImage($id, $user_id, $title)
    {
        $query = $this->link->prepare("UPDATE photos SET `title`= ? WHERE `id`='$id' AND `user_id`='$user_id'");
        $query->execute([$title]);
        return $query->rowCount();
    }

    public function deleteImage($id, $user_id)
    {
        $query = $this->link->query("DELETE FROM photos WHERE `id`='$id' AND `user_id`='$user_id'");
        // $values = array($id, $user_id);
        // $query->execute($values);
        return $query->rowCount();
    }

    public function createThumb($location, $filename)
    {
        $img = Image::make($location);
        $height = $img->height();
        $width = $img->width();
        $ratio = round($width/$height, 1);
        $img->resize(400, 400/$ratio);
        $thumbnail = $filename;
        $img->save($thumbnail);
        return $thumbnail;
    }

    public function makeImage($location)
    {
        return Image::make($location);
    }

    public function makeEdits(array $edits, $name, $location, $username)
    {
        $img = Image::make($location);
        $filePath = 'http://localhost/intervention/storage/new/';

        foreach($edits as $key=>$value)
        {
            if($value != 0){
                $img->$key($value);
            }
        }
        $res = $img->save('storage/'.$username.'/'.$name);

        $thumbLocation = 'storage/'.$username.'/thumbnails/'.$name;

        $thumbRes = $this->createThumb($location, $thumbLocation);

        if($res && $thumbRes)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
}

?>