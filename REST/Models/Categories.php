<?php

    require_once (ROOT . '/Components/ORM.php');

    class Categories extends ORM
    {
        public function GetTableName(): string
        {
            return 'categories';
        }

        public function GetFields(): array
        {
            return [
                'id' => 'id',
                'name' => 'string'
            ];
        }

        public function SelectId($name) : int{
            $sql = 'SELECT id FROM categories WHERE name = :name';

            $statement = Database::connection()->prepare($sql);
            $statement->bindValue(":name", $name);
            $statement->execute();

            $id = $statement->fetch(PDO::FETCH_ASSOC)['id'];
            var_dump($id);
            return $id;
        }

        public function DeleteRecord(int $id): bool
        {
            $product = new Products;
            $product->DeleteRecordByIdCategory($id);
            return parent::DeleteRecord($id);
        }
    }