<?php

    class Database
    {
        // Экземпляр данного класса
        private static $instance = null;

        // Экземпляр подключения к БД
        private $connection = null;

        // Запрещаем создание новых экземпляров снаружи класса
        protected function __construct(){
            $this->connection = new \PDO(
                "mysql:host=localhost;dbname=sport_product;charset=utf8",
                "root", "", ['PDO::ATTR_ERRMODE' => 'PDO::ERRMODE_EXCEPTION']
            );
        }

        // Запрещаем клонирование
        protected function __clone(){}

        // Запрещаем десериализацию
        public function __wakeup(){
            throw  new \BadMethodCallException("Unable to deserialize database connection");
        }

        // Создает экземпляр класса, хранящий подключение к БД
        public static function getInstance(): Database
        {
            if (null == self::$instance) {
                self::$instance = new static();
            }
            return self::$instance;
        }

        // Экземпляр подключения к БД
        public static function connection(): \PDO{
            return static::getInstance()->connection;
        }

        // Возвращает продукт из таблицы по указанному id
        public static function getProduct($id): array
        {
            $sql = "SELECT id, name, product_category.name_category, product.id_product, description, cost, img_path FROM product, product_category " .
                "WHERE product.id_product = id_product_category AND product.id = :id";

            $statement = static::connection()->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();

            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        // Возвращает массив продуктов из таблицы
        public static function getProducts(): array
        {
            $sql = "SELECT id, name, name_category, description, cost, img_path FROM product, product_category " .
                "WHERE product.id_product = id_product_category ORDER BY id";
            $result = static::connection()->query($sql);

            // Для видимости объявляем массив тут
            $data = array();

            $i = 0;
            while ($value = $result->fetch(PDO::FETCH_ASSOC)) {
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

        // Возвращает массив категорий продуктов из таблицы
        public static function getCategories(): array
        {
            $sql = "SELECT id_product_category, name_category FROM product_category";
            $result = static::connection()->query($sql);

            // Для видимости объявляем массив тут
            $text = array();
            $i = 0;



            while ($value = $result->fetch(PDO::FETCH_ASSOC))
            {
                $text[$i]['id_product_category'] = $value['id_product_category'];
                $text[$i]['name_category'] = $value['name_category'];
                $i++;
            }
            return $text;
        }

        /*  Добавляет продукт в БД
                $name           string
                $description    string
                $id_product     int
                $cost           int
                $img_path       string
        */
        public static function addProduct($name, $description, $id_product, $cost, $img_path){
            echo $name;
            $sql =  "INSERT INTO product(name, description, id_product, cost, img_path) ".
                    "VALUES(:name, :description, :id_product, :cost, :img_path)";
            $statement = static::connection()->prepare($sql);

            $statement->bindValue(":name", $name);
            $statement->bindValue(":description", $description);
            $statement->bindValue(":id_product", $id_product);
            $statement->bindValue(":cost", $cost);
            $statement->bindValue(":img_path", $img_path);

            $statement->execute();
        }

        // Проверяет, есть ли продукт с таким id в таблице
        public static function checkId($id): bool
        {
            $sql = "SELECT id FROM product WHERE id = :id";

            $statement = static::connection()->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();

            if ($statement->rowCount() == 1)
                return true;
            else
                return false;
        }

        /*  Изменяет продукт в БД
                $id             int
                $name           string
                $description    string
                $id_product     int
                $cost           int
                $img_path       string
        */
        public static function editProduct($id, $name, $description, $id_product, $cost, $img_path){
            // Удаляем картинку записи из локального хранилища
            static::deleteProductImage($id);

            // Обновляем запись
            $sql =  "UPDATE Product " .
                    "SET name = :name, description = :description, id_product = :id_product, cost = :cost, img_path = :img_path " .
                    "WHERE id = :id ";

            $statement = static::connection()->prepare($sql);

            $statement->bindValue(":id", $id);
            $statement->bindValue(":name", $name);
            $statement->bindValue(":description", $description);
            $statement->bindValue(":id_product", $id_product);
            $statement->bindValue(":cost", $cost);
            $statement->bindValue(":img_path", $img_path);

            echo " $id, $name, $description, $id_product, $cost, $img_path ";

            $statement->execute();
        }

        // Удаляет картинку из локального хранилища
        public static function deleteProductImage($id){
            $sql = "SELECT img_path FROM product WHERE id = :id";

            $statement = static::connection()->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();

            $path = $statement->fetch(PDO::FETCH_ASSOC);
            $images_dir = $_SERVER['DOCUMENT_ROOT'] . "/LR6/source/images/" . $path['img_path'];
            unlink($images_dir);
        }

        // Удаляет продукт из БД
        public static function deleteProduct($id){
            // Удаляем картинку записи из локального хранилища
            static::deleteProductImage($id);

            // Удаляем запись из БД
            $sql = "DELETE FROM product WHERE id = :id";

            $statement = static::connection()->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();
        }
    }

    // Проверяем класс на подключение
    try{
        Database::getInstance();
    }
    catch (PDOException $e)
    {
        die("Ошибка подключения к базе данных");
    }