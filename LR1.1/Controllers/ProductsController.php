<?php

    require_once ("Models/Products.php");
    require_once ("Models/Categories.php");

    class ProductsController implements IController
    {
        private Products $products;
        private Categories $categories;

        public function __construct(){
            $this->products = new Products();
            $this->categories = new Categories();
        }

        function actionIndex() : bool {
            require_once ('Views/Common/nav.php');

            $products = $this->products->GetRecords();
            $categoriesList = $this->categories->GetRecords();

            for($i = 0; $i < count($products) ; $i++) {
                for($j = 0; $j < count($categoriesList) ; $j++) {
                    if ($categoriesList[$j]['id'] == $products[$i]['id_category'])
                        $products[$i]['name_category'] = $categoriesList[$j]['name'];
                }
            }

            require_once ('Views/Other/Products/show.php');

            require_once ('Views/Common/footer.php');
            return true;
        }

        function actionShow(int $id = 0) : bool {
            require_once ('Views/Common/nav.php');

            if ($id != 0)
                $products = $this->products->GetProductsWithCategory($id, $this->categories);
            else{
                $productList = $this->products->GetRecords();
                $categoriesList = $this->categories->GetRecords();

                for($i = 0; $i < count($productList) ; $i++) {
                    for($j = 0; $j < count($categoriesList) ; $j++) {
                        if ($categoriesList[$j]['id'] == $productList[$i]['id_category'])
                            $productList[$i]['name_category'] = $categoriesList[$j]['name'];
                    }
                }
            }
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