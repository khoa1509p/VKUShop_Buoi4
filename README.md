# VKUShop — Buổi 04 Starter

**Chủ đề:** Prepared Statement và CRUD với PDO

Starter kế thừa trực tiếp Buổi 03 Completed. HTML/CSS đã chuẩn bị sẵn để tập trung vào PHP + MySQL.

## Chạy project

1. Import `database/database.sql` vào MySQL/phpMyAdmin. File sẽ tự tạo database `vkushop` và reset dữ liệu mẫu.
2. Mặc định `config/database.php` dùng MySQL local: `root` / mật khẩu rỗng. Sửa nếu máy của bạn khác.
3. Tại thư mục project:

```bash
php -S localhost:8000
```

4. Mở `http://localhost:8000`.

## TODO theo thứ tự buổi học

1. `create-product.php`: INSERT Product bằng `prepare()` + `execute()` rồi redirect.
2. `create-product.php`: thay mảng Category tạm bằng SELECT từ database.
3. `edit-product.php`: SELECT một Product theo `id`, dùng `fetch()` và prefill form.
4. `edit-product.php`: validation khi POST.
5. `edit-product.php`: UPDATE bằng prepared statement.
6. `delete-product.php`: DELETE Product bằng POST + prepared statement.
7. `create-category.php`: SV tự làm Create Category.
8. `edit-category.php`: SV tự làm Edit Category.
9. `delete-category.php`: SV tự làm Delete Category; Challenge không xóa Category đang được Product sử dụng.

## Ranh giới Buổi 4

- Có: PDO, `prepare()`, `execute()`, `fetch()`, CRUD, validation, redirect.
- Chưa có: OOP/MVC/Composer, Auth/Session, CSRF, Search SQL, Pagination, Upload, Transaction.
- Search Product vẫn lọc trên PHP array sau `fetchAll()` như Buổi 3.
