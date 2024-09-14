<?php

namespace Application\Models;

use CoffeeCode\DataLayer\Connect;
use CoffeeCode\DataLayer\DataLayer;

class BannerModel extends DataLayer
{
    public function __construct()
    {
        parent::__construct("banners", [
            "title",
            "subtitle",
            "image",
            "status"
        ]);
    }

    public function bootstrap(string $title, string $subtitle, string $image,string $status = "active"): BannerModel
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->image = $image;
        $this->status = $status;
        return $this;
    }

    public function search(): array
    {
        $connect = Connect::getInstance();
        return $connect->query("SELECT * FROM banners WHERE banners.status = 'active';")->fetchAll(\PDO::FETCH_OBJ);
    }
}