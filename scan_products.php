<?php
header('Content-Type: application/json');

$productsDir = __DIR__ . '/images/products';
$outputFile = __DIR__ . '/products.json';

if (!is_dir($productsDir)) {
    file_put_contents($outputFile, json_encode(['error' => 'Directory not found'], JSON_PRETTY_PRINT));
    exit;
}

$extensions = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'avif'];
$files = [];

function scanDirRecursive($dir, $exts) {
    $result = [];
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') continue;
        $fullPath = $dir . '/' . $item;
        if (is_dir($fullPath)) {
            $result = array_merge($result, scanDirRecursive($fullPath, $exts));
        } elseif (is_file($fullPath)) {
            $ext = strtolower(pathinfo($item, PATHINFO_EXTENSION));
            if (in_array($ext, $exts)) $result[] = $fullPath;
        }
    }
    return $result;
}

$allFiles = scanDirRecursive($productsDir, $extensions);
natsort($allFiles);

$badges = ['Limited', '18% OFF', 'New', '20% OFF', '17% OFF', 'Trending'];
$products = [];

foreach ($allFiles as $fullPath) {
    static $num = 1;
    $filename = basename($fullPath);
    $relPath = 'images/products/' . $filename;
    $badge = $num % 3 === 0 ? 'New' : ($num % 2 === 0 ? $badges[array_rand($badges)] : 'Limited');

    $products[] = [
        'id' => $num,
        'name' => 'Product ' . $num,
        'image' => $relPath,
        'badge' => $badge,
        'rating' => rand(4, 5),
        'reviews' => rand(50, 200),
        'features' => [
            'Premium quality material',
            'Handcrafted with care',
            'Durable and long-lasting',
            'Modern design',
            '5 year warranty included'
        ],
        'description' => 'High quality furniture piece crafted by Asian Furniture. Contact us for customization options and delivery details.'
    ];
    $num++;
}

$json = json_encode($products, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents($outputFile, $json);
echo $json;