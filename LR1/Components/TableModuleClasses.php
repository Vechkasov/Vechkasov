<?php


    class ProductTable{
        public static function GetProductsWithCategory(int $id_product) : ?array{
            $sql = "SELECT product.id, name, name_category, description, cost, img_path FROM product JOIN product_category " .
                "ON product.id_product = product_category.id WHERE product_category.id = :id_product ORDER BY product.id";

            // Для видимости объявляем массив тут
            $data = array();

            $statement = Database::connection()->prepare($sql);

            $statement->bindValue(":id_product", $id_product);

            $statement->execute();

            for($i = 0; $value = $statement->fetch(PDO::FETCH_ASSOC); $i++){
                $data[$i]['id'] = $value['id'];
                $data[$i]['img_path'] = $value['img_path'];
                $data[$i]['name'] = $value['name'];
                $data[$i]['name_category'] = $value['name_category'];
                $data[$i]['description'] = $value['description'];
                $data[$i]['cost'] = $value['cost'];
                $i++;
            }

            return $data;
        }
        public static function GetProducts() : ?array{
            $sql = "SELECT product.id, name, name_category, description, cost, img_path FROM product JOIN product_category " .
                "ON product.id_product = product_category.id ORDER BY product.id";
            $result = Database::connection()->query($sql);

            // Для видимости объявляем массив тут
            $data = array();

            for($i = 0; $value = $result->fetch(PDO::FETCH_ASSOC); $i++){
                $data[$i]['id'] = $value['id'];
                $data[$i]['img_path'] = $value['img_path'];
                $data[$i]['name'] = $value['name'];
                $data[$i]['name_category'] = $value['name_category'];
                $data[$i]['description'] = $value['description'];
                $data[$i]['cost'] = $value['cost'];
            }

            return $data;
        }
        public static function GetProduct($id) : array{
            $sql = "SELECT product.id, name, product_category.name_category, product.id_product, description, cost, img_path FROM product JOIN product_category " .
                "ON product.id_product = product_category.id WHERE product.id = :id";

            $statement = Database::connection()->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();

            return $statement->fetch(PDO::FETCH_ASSOC);
        }
        public static function AddProduct($name, $description, $id_product, $cost, $img_path){
            $sql =  "INSERT INTO product(name, description, id_product, cost, img_path) ".
                "VALUES(:name, :description, :id_product, :cost, :img_path)";
            $statement = Database::connection()->prepare($sql);

            $statement->bindValue(":name", $name);
            $statement->bindValue(":description", $description);
            $statement->bindValue(":id_product", $id_product);
            $statement->bindValue(":cost", $cost);
            $statement->bindValue(":img_path", $img_path);

            $statement->execute();
        }
        public static function DeleteProduct($id){
            // Удаляем картинку записи из локального хранилища
            static::DeleteProductImage($id);

            // Удаляем запись из БД
            $sql = "DELETE FROM product WHERE id = :id";

            $statement = Database::connection()->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();
        }
        public static function CheckId($id): bool
        {
            $sql = "SELECT id FROM product WHERE id = :id";

            $statement = Database::connection()->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();

            if ($statement->rowCount() == 1)
                return true;
            else
                return false;
        }
        private static function DeleteProductImage($id){
            $sql = "SELECT img_path FROM product WHERE id = :id";

            $statement = Database::connection()->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();

            $path = $statement->fetch(PDO::FETCH_ASSOC);
            $images_dir = $_SERVER['DOCUMENT_ROOT'] . "/Vechkasov/LR1/Template/productImages/" . $path['img_path'];
            unlink($images_dir);
        }
        public static function EditProduct($id, $name, $description, $id_product, $cost, $img_path){
            $sql =  "UPDATE Product " .
                "SET name = :name, description = :description, id_product = :id_product, cost = :cost";
            if ($img_path != null)
            {
                static::deleteProductImage($id);
                $sql .= ", img_path = :img_path";
            }
            $sql .= " WHERE id = :id ";

            $statement = Database::connection()->prepare($sql);

            $statement->bindValue(":id", $id);
            $statement->bindValue(":name", $name);
            $statement->bindValue(":description", $description);
            $statement->bindValue(":id_product", $id_product);
            $statement->bindValue(":cost", $cost);

            if ($img_path != null){
                $statement->bindValue(":img_path", $img_path);
            }

            $statement->execute();
        }
        public static function EditProductsWithCategory($first_id, $second_id){
            $sql = "UPDATE product SET id_product = :second_id WHERE id_product = :first_id";
            $statement = Database::connection()->prepare($sql);

            $statement->bindValue(":first_id", $first_id);
            $statement->bindValue(":second_id", $second_id);

            $statement->execute();
        }
        public static function DeleteProductsWithCategory($id){
            $sql = "SELECT id FROM product WHERE id_product = :id";
            $statement = Database::connection()->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();

            while($result = $statement->fetch(PDO::FETCH_ASSOC))
                self::DeleteProduct($result['id']);
        }
    }

    class ProductActions
    {
        public static function GetProducts(): array
        {
            if ($_SERVER['REQUEST_METHOD'] == 'GET' and !empty($_GET['id_category']) and intval($_GET['id_category']))
                $products = ProductTable::GetProductsWithCategory($_GET['id_category']);
            else
                $products = ProductTable::GetProducts();
            return $products;
        }
        public static function DeleteProduct(): bool
        {
            if (intval($_GET['id']) and ProductTable::CheckId($_GET['id'])) {
                ProductTable::DeleteProduct($_GET['id']);
                return true;
            }
            return false;
        }
        public static function AddProduct(): array
        {
            // Массив с ошибками
            $message = array();
            $pattern = '/[а-яёА-ЯЁa-zA-Z0-9&\s.,-]+$/u';

            if ($_POST) {

                if (isset($_POST['name'])){
                    if (empty(trim($_POST['name'])))
                        $message['name'] = "Вы не ввели название товара";
                    else if (!preg_match($pattern, $_POST['name']))
                        $message['name'] = "Название товара содержит неподходящие символы";
                }

                if (isset($_POST['description'])){
                    if (empty(trim($_POST['description'])))
                        $message['description'] = "Вы не ввели описание товара";
                    else if (!preg_match($pattern, $_POST['description']))
                        $message['description'] = "Описание содержит неподходящие символы";
                }

                if (isset($_POST['cost'])) {
                    if (empty(trim($_POST['cost'])))
                        $message['cost'] = "Вы не ввели цену товара";
                    else if (!is_numeric($_POST['cost']))
                        $message['cost'] = "Ошибка, вы ввели не число";
                    else if ($_POST['cost'] < 0)
                        $message['cost'] = "Ошибка, вы ввели отрицательное число";
                }

                if (isset($_FILES['image'])){
                    if (empty($_FILES['image']['tmp_name']))
                        $message['image'] = "Вы не отправили файл";
                    else if (!preg_match('/[а-яёА-ЯЁa-zA-Z0-9&_.,-]+(img|png|gif|jpg)$/u', $_FILES['image']['name']))
                        $message['image'] = "Ожидалось расширение типа img|png|gif";
                }

                if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['cost']) && isset($_POST['category']) && isset($_FILES['image']) && !empty($_FILES['image']['tmp_name']) && count($message) == 0) {
                    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/Vechkasov/LR1/Template/productImages/";
                    $new_name = $upload_dir . $_FILES['image']['name'];

                    move_uploaded_file($_FILES['image']['tmp_name'], $new_name);

                    $handle = fopen($new_name, 'r');
                    $content = fread($handle, filesize($new_name));
                    fclose($handle);

                    ProductTable::AddProduct($_POST['name'], $_POST['description'], intval($_POST['category']), intval($_POST['cost']), $_FILES['image']['name']);

                    header("Location: index.php");
                    exit();
                }
            }

            return $message;
        }
        public static function GetProduct()
        {
            if (isset($_GET['id']) and ProductTable::CheckId($_GET['id']))
                return ProductTable::GetProduct($_GET['id']);
            else {
                header("Location: index.php");
                exit();
            }
        }
        public static function EditProduct(): ?array{
            if (!$_SERVER['REQUEST_METHOD'] == 'POST' or !$_POST)
                return null;

            $pattern = '/[а-яёА-ЯЁa-zA-Z0-9&\s.,-]+$/u';
            $message = array();

            // Проверка ввода названия продукта
            if (isset($_POST['name'])){
                if (empty($_POST['name']))
                    $message['name'] = "Вы не ввели название товара";
                else if (!preg_match($pattern, $_POST['name']))
                    $message['name'] = "Название товара содержит неподходящие символы";
            }


            // Проверка ввода описания товара
            if (isset($_POST['description'])){
                if (empty($_POST['description']))
                    $message['description'] = "Вы не ввели описание товара";
                else if (!preg_match($pattern, $_POST['description']))
                    $message['description'] = "Описание содержит неподходящие символы";
            }

            // Проверка ввода стоимости товара
            if (isset($_POST['cost'])){
                if (empty($_POST['cost']))
                    $message['cost'] = "Вы не ввели цену товара";
                else if (!intval($_POST['cost']))
                    $message['cost'] = "Ошибка, вы ввели не число";
                else if ($_POST['cost'] < 0)
                    $message['cost'] = "Ошибка, вы ввели отрицательное число";
            }

            // Проверка типа отправленного изображения
            if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name']) and !preg_match('/[а-яёА-ЯЁa-zA-Z0-9&_.,-]+(img|png|gif|jpg)$/u', $_FILES['image']['name'])) {
                $message['image'] = "Ожидалось расширение типа img|png|gif|jpg";
            }

            if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['cost']) && isset($_POST['category']) && count($message) == 0) {
                if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name']))
                {
                    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/Vechkasov/LR1/Template/productImages/";
                    $new_name = $upload_dir . $_FILES['image']['name'];

                    move_uploaded_file($_FILES['image']['tmp_name'], $new_name);

                    $handle = fopen($new_name, 'r');
                    $content = fread($handle, filesize($new_name));
                    fclose($handle);

                    ProductTable::EditProduct(intval($_GET['id']), $_POST['name'], $_POST['description'], intval($_POST['category']), intval($_POST['cost']), $_FILES['image']['name']);
                }
                else
                    ProductTable::EditProduct(intval($_GET['id']), $_POST['name'], $_POST['description'], intval($_POST['category']), intval($_POST['cost']), null);
                header("Location: index.php");
            }
            return $message;
        }
    }

    class CategoryTable{
        public static function GetCategories(): ?array
        {
            $sql = "SELECT id, name_category FROM product_category";
            $result = Database::connection()->query($sql);

            // Для видимости объявляем массив тут
            $text = array();

            for($i = 0; $value = $result->fetch(PDO::FETCH_ASSOC) ; $i ++){
                $text[$i]['id'] = $value['id'];
                $text[$i]['name'] = $value['name_category'];
            }

            return $text;
        }
        public static function AddCategory($name) {
            $sql = "INSERT INTO product_category(name_category) VALUES(:name)";

            $statement = Database::connection()->prepare($sql);
            $statement->bindValue(":name", $name);
            $statement->execute();

            header("Location: categories.php");
            exit();
        }
        public static function CheckId($id): bool {
            $sql = "SELECT id FROM product_category WHERE id = :id";

            $statement = Database::connection()->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();

            if ($statement->rowCount() == 1)
                return true;
            else
                return false;
        }
        public static function DeleteCategory($id){
            $sql = "DELETE FROM product_category WHERE id = :id";

            $statement = Database::connection()->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();
        }
        public static function GetCategory($id){
            $sql = "SELECT id, name_category FROM product_category WHERE id = :id";

            $statement = Database::connection()->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();

            return $statement->fetch(PDO::FETCH_ASSOC);
        }
        public static function EditCategory($id, $name){
            $sql =  "UPDATE product_category SET name_category = :name WHERE id = :id";

            $statement = Database::connection()->prepare($sql);

            $statement->bindValue(":id", $id);
            $statement->bindValue(":name", $name);

            $statement->execute();
            header("Location: categories.php");
        }
    }

    class CategoryActions{
        public static function AddCategory(){
            if ($_POST){
                if (!empty(trim($_POST['name'])))
                    CategoryTable::AddCategory(trim($_POST['name']));
                else
                    return "Ошибка, вы не ввели название категории";
            }
        }
        public static function DeleteCategory()
        {
            if (CategoryTable::CheckId($_GET['id'])) {
                if ($_POST)
                {
                    if (isset($_POST['flexRadioDefault']) and isset($_POST['categories']))
                        ProductTable::EditProductsWithCategory($_GET['id'], $_POST['categories']);
                    else
                        ProductTable::DeleteProductsWithCategory($_GET['id']);
                    CategoryTable::DeleteCategory($_GET['id']);
                    header("Location: categories.php");
                    exit();
                }
            }
            else
                header("Location: categories.php");
        }
        public static function GetCategory(){
            if (CategoryTable::CheckId($_GET['id'])) {
                if($_POST)
                {
                    if (!empty(trim($_POST['name'])))
                        CategoryTable::EditCategory($_GET['id'], trim($_POST['name']));
                }
                else
                    return CategoryTable::GetCategory($_GET['id']);
            }
            else
                header("Location: categories.php");
        }
    }
