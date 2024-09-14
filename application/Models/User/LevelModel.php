<?php

namespace Application\Models\User;

use Application\ViewModel\LevelFilterViewModel;
use CoffeeCode\DataLayer\Connect;
use CoffeeCode\DataLayer\DataLayer;

class LevelModel extends DataLayer
{
    public function __construct()
    {
        parent::__construct("levels", [
            "name",
            "status"
        ]);
    }

    public function bootstrap(string $name, string $status = "active"): LevelModel
    {
        $this->name = $name;
        $this->status = $status;
        return $this;
    }

    public static function search(LevelFilterViewModel $filter): array
    {
        try{
            $sql = "SELECT * FROM levels WHERE levels.id <> :id AND levels.status = :status";
            if(!empty($filter->name)){
                $sql .= " AND levels.name like :name";
            }

            $connect = Connect::getInstance();
            $statement = $connect->prepare($sql);

            $statement->bindValue(":id", 1, \PDO::PARAM_INT);
            $statement->bindValue(":status", $filter->status, \PDO::PARAM_STR);

            if(!empty($filter->name)){
                $statement->bindValue(":name", '%' . $filter->name . '%', \PDO::PARAM_STR);
            }

            $statement->execute();

            return $statement->fetchAll(\PDO::FETCH_OBJ);
        } catch (\PDOException $exception){
            return [];
        }
    }

    public static function load(int $id): ?DataLayer
    {
        return (new LevelModel())->findById($id);
    }
}