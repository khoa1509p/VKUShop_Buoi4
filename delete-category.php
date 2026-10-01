<?php
require_once __DIR__ . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') exit('Phương thức không hợp lệ.');

$categoryId = (int) ($_POST['id'] ?? 0);
if ($categoryId <= 0) exit('ID danh mục không hợp lệ.');

// TODO 9: DELETE Category bằng prepared statement.
// Challenge: nếu Category đang có Product thì không cho xóa và redirect
// về categories.php?delete_error=in_use.
exit('TODO: Hoàn thiện Delete Category.');
