<?php
$app_env = $_SERVER['APP_ENV'] ?? 'production';

if ($app_env === 'production') {
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    error_reporting(0);
    error_log('D:/laragon/logs/php_errors.log');
} else {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}


// file konfigurasi
require_once 'config.php'; 

// Koneksi ke database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_POST['add_printer'])) {
    $name = $_POST['name'];
    $model = $_POST['model'];
    $status = $_POST['status'];
    $service_date = $_POST['service_date'];
    $customer = $_POST['customer'];
    $customer_number = $_POST['customer_number'];

    $query = "INSERT INTO printers (name, model, status, service_date, customer, customer_number) 
              VALUES ('$name', '$model', '$status', '$service_date', '$customer', '$customer_number')";
    if ($conn->query($query) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}


$printers = $conn->query("SELECT * FROM printers");

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM printers WHERE id = $id");
    $printer = $result->fetch_assoc();
}

if (isset($_POST['update_printer'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $model = $_POST['model'];
    $status = $_POST['status'];
    $service_date = $_POST['service_date'];
    $customer = $_POST['customer'];
    $customer_number = $_POST['customer_number'];

    $query = "UPDATE printers SET name='$name', model='$model', status='$status', service_date='$service_date', 
              customer='$customer', customer_number='$customer_number' WHERE id=$id";
    if ($conn->query($query) === TRUE) {
        echo "Data printer berhasil diperbarui.";
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

if (isset($_POST['delete_printer'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM printers WHERE id=$id";
    if ($conn->query($query) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Printer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-10 px-4 sm:px-6 md:px-8">
        <h1 class="text-3xl font-bold mb-6">Sistem Manajemen Printer</h1>

        <!-- Form Add -->
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="text-xl font-semibold mb-4">Tambah Printer</h2>
            <form method="POST" action="">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="customer">Nama Customer</label>
                    <input type="text" name="customer" id="customer" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="customer_number">Nomor Customer</label>
                    <input type="text" name="customer_number" id="customer_number" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nama Printer</label>
                    <input type="text" name="name" id="name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="model">Model</label>
                    <input type="text" name="model" id="model" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">Status</label>
                    <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                        <option value="Servis">Servis</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="service_date">Tanggal Servis</label>
                    <input type="date" name="service_date" id="service_date" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                </div>
                
                <div class="flex items-center justify-between">
                    <button type="submit" name="add_printer" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Tambah Printer
                    </button>
                </div>
            </form>
        </div>

        <!-- Form Edit -->
        <?php if (isset($printer)): ?>
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="text-xl font-semibold mb-4">Edit Printer</h2>
            <form method="POST" action="">
                <input type="hidden" name="id" value="<?= $printer['id']; ?>">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="customer">Nama Customer</label>
                    <input type="text" name="customer" id="customer" value="<?= $printer['customer']; ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="customer_number">Nomor Customer</label>
                    <input type="text" name="customer_number" id="customer_number" value="<?= $printer['customer_number']; ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nama Printer</label>
                    <input type="text" name="name" id="name" value="<?= $printer['name']; ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="model">Model</label>
                    <input type="text" name="model" id="model" value="<?= $printer['model']; ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="status">Status</label>
                    <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                        <option value="Servis" <?= $printer['status'] === 'Servis' ? 'selected' : ''; ?>>Servis</option>
                        <option value="Selesai" <?= $printer['status'] === 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="service_date">Tanggal Servis</label>
                    <input type="date" name="service_date" id="service_date" value="<?= $printer['service_date']; ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                </div>
                
                <div class="flex items-center justify-between">
                    <button type="submit" name="update_printer" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Simpan Perubahan
                    </button>
                    <a href="index.php" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Batal</a>
                </div>
            </form>
        </div>
        <?php endif; ?>

        <!-- Tabel Data -->
<div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-6">
    <h2 class="text-xl font-semibold mb-4">Daftar Printer</h2>
    <!-- Menambahkan div dengan overflow-x-auto untuk membuat scroll horizontal -->
    <div class="overflow-x-auto">
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Pelanggan</th>
                    <th class="px-4 py-2">Nomor Pelanggan</th>
                    <th class="px-4 py-2">Nama Printer</th>
                    <th class="px-4 py-2">Model</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Tanggal Servis</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($printer = $printers->fetch_assoc()): ?>
                <tr>
                    <td class="border px-4 py-2"><?= $printer['customer']; ?></td>
                    <td class="border px-4 py-2"><?= $printer['customer_number']; ?></td>
                    <td class="border px-4 py-2"><?= $printer['name']; ?></td>
                    <td class="border px-4 py-2"><?= $printer['model']; ?></td>
                    <td class="border px-4 py-2"><?= $printer['status']; ?></td>
                    <td class="border px-4 py-2"><?= $printer['service_date']; ?></td>
                    <td class="border px-4 py-2">
                        <a href="index.php?edit=<?= $printer['id']; ?>" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">Edit</a>
                        <form method="POST" action="" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $printer['id']; ?>">
                            <button type="submit" name="delete_printer" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <br>
    <a href="export_excel.php" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Ekspor ke Excel</a>
</div>

        
    </div>
    
</body>
</html>
