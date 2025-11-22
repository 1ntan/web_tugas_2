<!DOCTYPE html>
<html lang="id">
    
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Edit Produk' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-amber-50 min-h-screen flex flex-col">

<header class="w-full bg-amber-800 text-white py-4 px-6 flex items-center shadow relative">
    
    <!-- Tombol Back -->
    <a href="index.php" 
       class="absolute left-6 bg-amber-700 hover:bg-amber-600 px-3 py-1 rounded text-sm shadow transition">
        ← Kembali
    </a>

    <!-- Judul -->
    <h1 class="text-2xl font-bold mx-auto">🍞 Edit Produk</h1>

    <!-- Admin -->
    <span class="font-semibold absolute right-6">👤 Admin</span>
</header>

<div class="p-6 flex-grow">
