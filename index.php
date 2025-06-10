<?php
header('Content-Type: application/json');
require_once 'db.php';

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

if ($method !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Csak GET kérés engedélyezett.']);
    exit;
}

$path = explode('/', trim(parse_url($uri, PHP_URL_PATH), '/'));

if ($path[0] !== 'laptops') {
    http_response_code(404);
    echo json_encode(['error' => 'Nincs ilyen végpont.']);
    exit;
}

// /laptops
if (count($path) === 1) {
    $stmt = $pdo->query('SELECT * FROM laptops');
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    exit;
}

// /laptops/5
if (count($path) === 2 && is_numeric($path[1])) {
    $id = (int)$path[1];
    $stmt = $pdo->prepare('SELECT * FROM laptops WHERE id = ?');
    $stmt->execute([$id]);
    $laptop = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($laptop) {
        echo json_encode($laptop);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Nincs ilyen laptop.']);
    }
    exit;
}

// /laptops/manufacturer/Asus
if (count($path) === 3 && $path[1] === 'manufacturer') {
    $manufacturer = urldecode($path[2]);
    $stmt = $pdo->prepare('SELECT * FROM laptops WHERE manufacturer = ?');
    $stmt->execute([$manufacturer]);
    $laptops = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($laptops) {
        echo json_encode($laptops);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Nincs ilyen gyártó.']);
    }
    exit;
}

http_response_code(404);
echo json_encode(['error' => 'Érvénytelen végpont.']);
