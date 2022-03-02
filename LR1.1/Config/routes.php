<?php

    // Controllers/Action
    return array(
        // Изменение продукта
        HOST . '/products/edit/([0-9]?)' => 'products/edit/$1',
        // Удаление продукта
        HOST . '/products/delete/([0-9]?)' => 'products/delete/$1',
        // Просмотр продуктов с определенной категорией
        HOST . '/products/show/([0-9]?)' => 'products/show/$1',
        // Просмотр продуктов
        HOST . '/products/show' => 'products/index',
        // Добавление продукта
        HOST . '/products/add' => 'products/add',

        // Изменение продукта
        HOST . '/categories/edit/([0-9]?)' => 'categories/edit/$1',
        // Удаление продукта
        HOST . '/categories/delete/([0-9]?)' => 'categories/delete/$1',
        // Просмотр продуктов
        HOST . '/categories/show' => 'categories/show',
        // Добавление продукта
        HOST . '/categories/add' => 'categories/add',

        HOST => 'products/index',
    );