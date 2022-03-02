<?php

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

        public function EditCategory(int $id){
            if($_POST)
                if ($this->CheckString($_POST['name']) == null) {
                    parent::EditRecord(array(
                        'id' => $id,
                        'name' => trim($_POST['name'])
                    ));
                }
        }

        public function AddCategory() {
            if($_POST)
            {
                if ($this->CheckString($_POST['name']) == null) {
                    parent::AddRecord(array(
                        'name' => trim($_POST['name'])
                    ));
                }
                else
                    return $this->CheckString($_POST['name']);
            }
        }

        public function DeleteCategory(int $id, Products $products){
            if ($_POST)
            {
                if (isset($_POST['flexRadioDefault']) and isset($_POST['categories']))
                    $products->EditProductsWithCategory($id, $_POST['categories']);
                else
                    $products->DeleteProductsWithCategory($id, $this);
                $this->DeleteRecord($id);

                header("Location: /" . HOST . "/" . $this->GetTableName() . "/show");
                exit();
            }
        }

    }