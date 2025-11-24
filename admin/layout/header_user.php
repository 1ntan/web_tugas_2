<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Toko Roti' ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-amber-50 min-h-screen flex flex-col">

<header class="w-full bg-amber-800 text-white py-4 px-6 flex justify-between items-center shadow relative">

<!-- Tombol Back Elegan -->
    <a href="javascript:history.back()" 
    class="absolute left-6 text-white text-2xl drop-shadow-[0_0_4px_#4E342E] hover:drop-shadow-[0_0_6px_#3E2723] transition">
        ←
    </a>

    <!-- Judul -->
    <h1 class="text-2xl font-bold mx-auto">Daftar Produk</h1>

    <!-- Bagian kanan -->
    <div class="absolute right-6 flex items-center gap-3">
        
    <a href="?preview=user" 
    class="text-white font-bold px-4 py-2 rounded-lg shadow hover:text-gray-200 transition ml-2">
    Preview User
    </a>


        <!-- Label Admin -->
        <span class="font-semibold">👤 user</span>
    </div>

</header>

<div class="p-6 flex-grow">
