<?php
// Instantiate the DB class
require_once "../models/db.php";
$db = new DB();

// Fetch total number of rows
$totalRows = count($product);

// Calculate total number of pages
$rowsPerPage = 3;
$pages = ceil($totalRows / $rowsPerPage);

// Output pagination links
echo '<nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">';
echo '<li class="page-item"><a class="page-link" href="?page-nr=1" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
for ($i = 1; $i <= $pages; $i++) {
    echo '<li class="page-item"><a class="page-link" href="?page-nr=' . $i . '">' . $i . '</a></li>';
}
echo '<li class="page-item"><a class="page-link" href="?page-nr=' . $pages . '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
echo '</ul></nav>';
