<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi
{
    public $id_penggunaWeb;
    public $title;
    public $imageCard;
    public $imageBackground;
    public $imageCardAdmin;
    public $imageStatistic;

    public function __construct($id_penggunaWeb, $title, $imageCard, $imageBackground, $imageCardAdmin, $imageStatistic)
    {
        $this->id_penggunaWeb = $id_penggunaWeb;
        $this->title = $title;
        $this->imageCard = $imageCard;
        $this->imageBackground = $imageBackground;
        $this->imageCardAdmin = $imageCardAdmin;
        $this->imageStatistic = $imageStatistic;
    }
}