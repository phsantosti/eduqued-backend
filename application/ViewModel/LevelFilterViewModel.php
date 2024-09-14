<?php

namespace Application\ViewModel;

class LevelFilterViewModel
{
    public ?string $name = null;
    public ?string $status = "active";

    public function __construct(?array $data)
    {
        $this->name = (empty($data["name"]) ? null : $data["name"]);
        $this->status = (empty($data["status"]) ? "active" : $data["status"]);
    }
}