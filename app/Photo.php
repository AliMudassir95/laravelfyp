<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['file'];

    protected $upload_directory = "/images/";

    public function getFileAttribute($file){
        return $this->upload_directory . $file;
    }

}
