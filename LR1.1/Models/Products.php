<?php

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
                'img_path' => 'image'
            ];
        }

        public function GetProducts(Categories $categories): ?array
        {
            $productList = parent::GetRecords();

            $categoriesList = $categories->GetRecords();

            for($i = 0; $i < count($productList) ; $i++) {
                for($j = 0; $j < count($categoriesList) ; $j++) {
                    if ($categoriesList[$j]['id'] == $productList[$i]['id_category'])
                        $productList[$i]['name_category'] = $categoriesList[$j]['name'];
                }
            }

            return $productList;
        }

        private function CheckValues() : ?array{
            if (!$_POST)
                return null;

            $message = array();

            parent::CheckString($_POST['name']) == null ? : $message['name'] = parent::CheckString($_POST['name']) ;
            parent::CheckString($_POST['description']) == null ? : $message['description'] = parent::CheckString($_POST['description']) ;
            parent::CheckInt($_POST['cost']) == null ? : $message['cost'] = parent::CheckInt($_POST['cost']) ;

            return $message;
        }

        public function AddProduct() : ?array{
            $message = $this->CheckValues();

            if (isset($_FILES['image'])){
                if (empty($_FILES['image']['tmp_name']))
                    $message['image'] = "Вы не отправили файл";
                else if (!preg_match('/[а-яёА-ЯЁa-zA-Z0-9&_.,-]+(img|png|gif|jpg)$/u', $_FILES['image']['name']))
                    $message['image'] = "Ожидалось расширение типа img|png|gif";
            }

            if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['cost']) && isset($_POST['category']) && isset($_FILES['image']) && !empty($_FILES['image']['tmp_name']) && count($message) == 0) {
                $this->SaveImage();

                parent::AddRecord(array(
                        'name' => $_POST['name'],
                        'description' => $_POST['description'],
                        'id_category' => intval($_POST['category']),
                        'cost' => intval($_POST['cost']),
                        'img_path' => $_FILES['image']['name'])
                );
            }

            return $message;
        }

        public function EditProduct(int $id) : ?array{
            $message = $this->CheckValues();

            if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name']) and !preg_match('/[а-яёА-ЯЁa-zA-Z0-9&_.,-]+(img|png|gif|jpg)$/u', $_FILES['image']['name']))
                $message['image'] = "Ожидалось расширение типа img|png|gif|jpg";

            if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['cost']) && isset($_POST['category']) && count($message) == 0) {
                $params = array(
                    'id' => $id,
                    'name' => trim($_POST['name']),
                    'description' => trim($_POST['description']),
                    'id_category' => intval($_POST['category']),
                    'cost' => intval($_POST['cost'])
                );

                if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name']))
                {
                    $this->SaveImage();

                    $params['img_path'] = $_FILES['image']['name'];
                    parent::EditRecord($params);
                }
                else
                    parent::EditRecord($params);
            }
            return $message;
        }

        public function DeleteProduct(int $id){
            $path = $this->GetRecord($id)['img_path'];

            $this->DeleteImage($path);
            $this->DeleteRecord($id);
        }

        public function GetProductsWithCategory(int $id, Categories $categories) : ?array{
            $categories->CheckId($id);

            $productsList = $this->GetProducts($categories);

            $count = count($productsList);

            for($i = 0; $i < $count ; $i++)
                if ($productsList[$i]['id_category'] != $id)
                    unset($productsList[$i]);

            return $productsList;
        }

        public function EditProductsWithCategory(int $first_id, int $second_id){
            $sql = "UPDATE products SET id_category = :second_id WHERE id_category = :first_id";
            $statement = Database::connection()->prepare($sql);

            $statement->bindValue(":first_id", $first_id);
            $statement->bindValue(":second_id", $second_id);

            $statement->execute();
        }

        public function DeleteProductsWithCategory(int $id, Categories $categories){
            $products = $this->GetProducts($categories);
            $count = count($products);

            for($i = 0; $i < $count ; $i++)
                if ($products[$i]['id_category'] == $id)
                    $this->DeleteProduct($products[$i]['id']);
        }
    }