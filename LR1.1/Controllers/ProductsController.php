<?php

    require_once ("Models/Products.php");
    require_once ("Models/Categories.php");

    class ProductsController
    {
        private Products $products;
        private Categories $categories;

        public function __construct(){
            $this->products = new Products();
            $this->categories = new Categories();
        }

        function actionIndex() : bool {
            require_once ('Views/Common/nav.php');

            $products = $this->products->GetProducts($this->categories);

            require_once ('Views/Other/Products/show.php');

            require_once ('Views/Common/footer.php');
            return true;
        }

        function actionShow(int $id) : bool {
            require_once ('Views/Common/nav.php');

            $products = $this->products->GetProductsWithCategory($id, $this->categories);
            require_once ('Views/Other/Products/show.php');

            require_once ('Views/Common/footer.php');
            return true;
        }

        function actionEdit(int $id) : bool {
            require_once ('Views/Common/nav.php');

            $categories = $this->categories->GetRecords();

            $this->products->CheckId($id);
            $product = $this->products->GetRecord($id);
            $errors = $this->products->EditProduct($id);
            require_once ('Views/Other/Products/edit.php');

            require_once ('Views/Common/footer.php');
            return true;
        }

        function actionDelete(int $id) : bool {
            $this->products->DeleteProduct($id);

            header("Location: /" . HOST . "/" . $this->products->GetTableName() . "/show");
            exit();
        }

        function actionAdd() : bool {
            require_once ('Views/Common/nav.php');

            $categories = $this->categories->GetRecords();
            $errors = $this->products->AddProduct();
            require_once ('Views/Other/Products/add.php');

            require_once ('Views/Common/footer.php');
            return true;
        }
    }