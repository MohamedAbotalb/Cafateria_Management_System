
<?php

require_once "../models/db.php";

class CategoryManager
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function addCategory($categoryName)
    {
        // Validate the category name
        $this->validateCategoryName($categoryName);

        // Check if the category already exists
        if ($this->categoryExists($categoryName)) {
            return ['success' => false, 'message' => 'Category already exists'];
        }

        // Insert the new category into the database
        $this->db->insert("category", ["name" => $categoryName]);
        $insertedCategory = $this->db->select("category", ["name"], [$categoryName]);

        return [
            'success' => true,
            'message' => 'Category added successfully',
            'insertedCategory' => $insertedCategory
        ];
    }

    private function validateCategoryName($categoryName)
    {
        // Validate the new category name
        $categoryName = trim($categoryName);
        if (empty($categoryName)) {
            throw new Exception('Category name cannot be empty');
        }
        // Check if the category name contains any numeric characters or special characters
        if (preg_match('/[^A-Za-z\s]/', $categoryName)) {
            throw new Exception('Category name can only contain letters and spaces, and cannot contain numbers or special characters');
        }
    }

    private function categoryExists($categoryName)
    {
        $existingCategory = $this->db->select("category", ["name"], [$categoryName]);
        return $existingCategory ? true : false;
    }

    public function processRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $newCategoryName = $_POST["newCategoryName"];

                $response = $this->addCategory($newCategoryName);
            } catch (Exception $e) {
                $response = ['success' => false, 'message' => $e->getMessage()];
            }

            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }

        echo json_encode(['success' => false, 'message' => 'Invalid request']);
        exit();
    }
}

$categoryManager = new CategoryManager();
$categoryManager->processRequest();
