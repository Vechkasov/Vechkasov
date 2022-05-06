<?php

    define('ROOT', dirname(__FILE__));

    use Silex\Application;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    require_once ROOT . '/vendor/autoload.php';
    require_once ROOT . '/Models/Products.php';
    require_once ROOT . '/Models/Categories.php';

    $app = new Application();

    $app['debug'] = true;

    $app->post('/upload', function () use ($app) {
        $product = new Products;

        if (isset($_FILES['image'])){
            if (isset($_POST['id']))
                $product->DeleteImageByIdProduct($_POST['id']);
            $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/REST/assets/";
            $new_name = $upload_dir . $_FILES['image']['name'];

            move_uploaded_file($_FILES['image']['tmp_name'], $new_name);

            $handle = fopen($new_name, 'r');
            $content = fread($handle, filesize($new_name));
            fclose($handle);

            // Поменять у отдельного элемента по id
            if(isset($_POST['id'])){
                $product->CheckoutImage($_FILES['image']['name'], $_POST['id']);
            }
            // Вставить в конец
            else{
                $product->CheckoutImage($_FILES['image']['name']);
            }

            return $app->json(array("upload-image" => "yes"));
        }
        else
            return $app->json(array("upload-image" => "no"));
    });

    // Products

    # CREATE
    $app->post('/product/add', function () use ($app) {
        $json = file_get_contents('php://input');
        $params = json_decode($json, true);

        if (isset($params['name']) and !empty(trim($params['name']))
        and isset($params['description']) and !empty(trim($params['description']))
        and isset($params['cost']) and !empty(trim($params['cost'])) and is_numeric($params['cost'])
        and isset($params['category']) and !empty(trim($params['category']))) {
            $product = new Products();
            $category = new Categories;
            $data = array(
                'name' => trim($params['name']),
                'description' => trim($params['description']),
                'cost' => intval($params['cost']),
                'id_category' => $category->SelectId($params['category'])
            );
            var_dump($data);
            if ($product->AddRecord($data))
                return $app->json(array("create-product" => "yes"));
            else
                return $app->json(array("create-product" => "no"));
        }
        else
            return $app->json(array("create-product" => "no"));
    });

    # READ
    $app->get('/product/list/{id}', function ($id) use ($app) {
        $product = new Products();
        $category = new Categories();
        if (!$id)
            $productList = $product->GetRecords();
        else if ($id and $category->CheckId($id))
            $productList = $product->GetRecordsByCategory($id);
        else
            return $app->json();
        return $app->json($productList);
    })->value('id', NULL);

    $app->get('/product/list/{id}', function (int $id) use ($app) {
        $product = new Products();
        $productList = $product->GetRecords();
        return $app->json($productList);
    });

    # UPDATE
    $app->post('/product/edit', function () use ($app) {
        $json = file_get_contents('php://input');
        $params = json_decode($json, true);

        if (isset($params['name']) and !empty(trim($params['name']))
        and isset($params['description']) and !empty(trim($params['description']))
        and isset($params['cost']) and !empty(trim($params['cost'])) and is_numeric($params['cost'])
        and isset($params['category']) and !empty(trim($params['category']))
        and isset($params['id']) and is_numeric($params['id'])) {
            $product = new Products;
            $category = new Categories;

            $data = array(
                'id' => intval($params['id']),
                'name' => trim($params['name']),
                'description' => trim($params['description']),
                'cost' => intval($params['cost']),
                'id_category' => $category->SelectId($params['category'])
            );

            //if (isset($params['img_path']))
               // $data['img_path'] = $params['img_path'];

            if ($product->EditRecord($data))
                return $app->json(array("update-product" => "yes"));
            else
                return $app->json(array("update-product" => "no"));
        } else
            return $app->json(array("update-product" => "no"));
    });

    # DELETE
    $app->post('/product/delete', function () use ($app){
        $json = file_get_contents('php://input');
        $params = json_decode($json, true);

        $product = new Products();
        if (isset($params['id']) and is_numeric($params['id'])
        and $product->CheckId($params['id']) and $product->DeleteRecord($params['id']))
            return $app->json(array("delete-product" => "yes"));
        else
            return $app->json(array("delete-product" => "no"));
    });

    // Categories

    # CREATE
    $app->post('/category/add', function () use ($app) {
        $json = file_get_contents('php://input');
        $params = json_decode($json, true);

        if (isset($params['name']) and !empty(trim($params['name']))){
            $category = new Categories();
            $data = array(
                'name' => $params['name']
            );

            if ($category->AddRecord($data))
                return $app->json(array("create-category" => "yes"));
            else
                return $app->json(array("create-category" => "no"));
        }
        else
            return $app->json(array("create-category" => "no"));
    });

    # READ
    $app->get('/category/list', function () use ($app) {
        $category = new Categories();
        $categoryList = $category->GetRecords();
        return $app->json($categoryList);
    });

    # UPDATE
    $app->post('/category/edit', function () use ($app) {
        $json = file_get_contents('php://input');
        $params = json_decode($json, true);

        if (isset($params['id']) and is_numeric($params['id'])
        and isset($params['name']) and !empty(trim($params['name']))) {
            $category = new Categories();
            $data = array(
                'id' => intval($params['id']),
                'name' => trim($params['name'])
            );

            if ($category->EditRecord($data))
                return $app->json(array("update-category" => "yes"));
            else
                return $app->json(array("update-category" => "no"));
        } else
            return $app->json(array("update-category" => "no"));
    });

    # DELETE
    $app->post('/category/delete', function () use ($app){
        $json = file_get_contents('php://input');
        $params = json_decode($json, true);

        $category = new Categories();
        if (isset($params['id']) and is_numeric($params['id'])
        and $category->CheckId($params['id']) and $category->DeleteRecord($params['id']))
            return $app->json(array("delete-category" => "yes"));
        else
            return $app->json(array("delete-category" => "no"));
    });

    $app->after(function (Request $request, Response $response) {
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,OPTIONS');
    });

$app->run();