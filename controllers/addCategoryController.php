<?php
require_once "../models/db.php";

class CategoryController
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function addCategory($categoryName)
    {
        $categoryName = trim($categoryName);
        $existingCategory = $this->db->select("category", ["name"], [$categoryName], true);
        if ($existingCategory) {
            return json_encode(["success" => false, "message" => "Category already exists."]);
        } else {
            $this->db->insert("category", ["name" => $categoryName]);
            return json_encode(["success" => true, "categoryName" => $categoryName]);
        }
    }
}

$categoryController = new CategoryController();
echo $categoryController->addCategory($_POST["categoryName"]);
