<?php

    require_once ("Models/Categories.php");
    require_once ("Models/Products.php");

    class CategoriesController
    {
        private Categories $categories;
        private Products $products;

        public function __construct(){
            $this->categories = new Categories();
            $this->products = new Products();
        }

        function actionShow() : bool {
            require_once ('Views/Common/nav.php');

            $categories = $this->categories->GetRecords();
            require_once ('Views/Other/Categories/show.php');

            require_once ('Views/Common/footer.php');
            return true;
        }

        function actionEdit(int $id) : bool {
            $this->categories->CheckId($id);
            require_once ('Views/Common/nav.php');

            $categories = $this->categories->GetRecord($id);
            $this->categories->EditCategory($id);
            require_once ('Views/Other/Categories/edit.php');

            require_once ('Views/Common/footer.php');
            return true;
        }

        function actionDelete(int $id) : bool {
            $this->categories->CheckId($id);
            require_once ('Views/Common/nav.php');

            $categories = $this->categories->GetRecords();
            $this->categories->DeleteCategory($id, $this->products);

            $num = 0;
            foreach ($categories as $key => $item) {
                if ($item['id'] == $id) {
                    $header = "Удаление категории " . $item['name'];
                    $num = $item['id'];
                }
            }

            for ($i = 0; $i < count($categories); $i++)
                if ($categories[$i]['id'] == $num)
                    unset($categories[$i]);

            require_once ('Views/Other/Categories/delete.php');

            require_once ('Views/Common/footer.php');
            return true;
        }

        function actionAdd() : bool {
            require_once ('Views/Common/nav.php');

            $errors = $this->categories->AddCategory();
            require_once ('Views/Other/Categories/add.php');

            require_once ('Views/Common/footer.php');
            return true;
        }
    }