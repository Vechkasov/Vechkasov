<?php

    require_once (ROOT . '/Components/ORM.php');

    class Products extends ORM
    {
        public function GetTableName(): string
        {
            return 'products';
        }
        public function GetFields(): array
        {
            return [
                'id' => 'id',
                'name' => 'string',
                'description' => 'string',
                'cost' => 'int',
                'name_category' => 'list',
                'id_category' => 'int',
                'img_path' => 'file'
            ];
        }

        public function GetRecords(): ?array
        {
            $productList = parent::GetRecords();

            $category = new Categories();
            $categoriesList = $category->GetRecords();

            for($i = 0; $i < count($productList) ; $i++) {
                for($j = 0; $j < count($categoriesList) ; $j++) {
                    if ($categoriesList[$j]['id'] == $productList[$i]['id_category']){
                        $productList[$i]['id_category'] = $categoriesList[$j]['id'];
                        $productList[$i]['category'] = $categoriesList[$j]['name'];
                    }
                }
            }

            for($i = 0; $i < count($productList) ; $i++)
                $productList[$i]['img_path'] = "http://localhost/REST/assets/" . $productList[$i]['img_path'];

            return $productList;
        }

        public function GetRecordsByCategory($id): ?array
        {
            $productList = $this->GetRecords();
            $result = array();

            for($i = 0; $i < count($productList) ; $i++) {
                if ($productList[$i]['id_category'] == $id)
                    $result[] = $productList[$i];
            }

            return $result;
        }

        public function CheckoutImage(string $name, int $id = 0):bool{
            var_dump(func_get_args());
            if ($id != 0){
                $sql = "UPDATE products SET img_path = :name WHERE id = :id";
                $statement = Database::connection()->prepare($sql);
                $statement->bindValue(":id", $id);
            }
            else{
                $sql = "UPDATE products SET img_path = :name WHERE id = (SELECT MAX(id) FROM products)";
                $statement = Database::connection()->prepare($sql);
            }
            $statement->bindValue(":name", $name);
            return $statement->execute();
        }

        public function DeleteRecordByIdCategory(int $id){
            $sql = 'SELECT id FROM products WHERE id_category = :id';

            $statement = Database::connection()->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();

            for($i = 0; $value = $statement->fetch(PDO::FETCH_ASSOC); $i++)
                $this->DeleteRecord($value['id']);
        }

        public function DeleteImageByIdProduct($id){
            $sql = 'SELECT img_path FROM products WHERE id = :id';

            $statement = Database::connection()->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();

            $path = $statement->fetch(PDO::FETCH_ASSOC)['img_path'];
            $images_dir = $_SERVER['DOCUMENT_ROOT'] . "/REST/assets/" . $path;

            if (file_exists($images_dir))
                unlink($images_dir);
        }

        public function DeleteRecord(int $id): bool
        {
            $path = $this->GetRecord($id)['img_path'];
            $images_dir = $_SERVER['DOCUMENT_ROOT'] . "/REST/assets/" . $path;

            if (file_exists($images_dir))
                unlink($images_dir);
            return parent::DeleteRecord($id);
        }
    }