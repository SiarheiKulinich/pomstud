<?php
require __DIR__ . '/db.php';

migrate();

$action = $_GET['action'] ?? 'list';

switch ($action) {
    case 'create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = get_db();
            $stmt = $db->prepare('INSERT INTO customers (name, email, phone, created_at) VALUES (?, ?, ?, ?)');
            $stmt->execute([
                $_POST['name'],
                $_POST['email'],
                $_POST['phone'],
                date('c')
            ]);
            header('Location: index.php');
            exit;
        }
        $template = 'customer_form.php';
        $customer = ['name' => '', 'email' => '', 'phone' => ''];
        break;
    case 'edit':
        $db = get_db();
        $id = (int)$_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $db->prepare('UPDATE customers SET name=?, email=?, phone=? WHERE id=?');
            $stmt->execute([
                $_POST['name'],
                $_POST['email'],
                $_POST['phone'],
                $id
            ]);
            header('Location: index.php');
            exit;
        }
        $stmt = $db->prepare('SELECT * FROM customers WHERE id=?');
        $stmt->execute([$id]);
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);
        $template = 'customer_form.php';
        break;
    case 'delete':
        $db = get_db();
        $id = (int)$_GET['id'];
        $db->prepare('DELETE FROM customers WHERE id=?')->execute([$id]);
        header('Location: index.php');
        exit;
    default:
        $db = get_db();
        $customers = $db->query('SELECT * FROM customers ORDER BY created_at DESC')->fetchAll(PDO::FETCH_ASSOC);
        $template = 'customers.php';
}

