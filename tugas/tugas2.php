<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buah di Toko Buah</title>
    <link rel="stylesheet" href="tugas2.css">
</head>
<body>
    <div class="container">
        <h1>Data Buah di Toko Buah</h1>

        <?php
        // Connect to the database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "tokobuah";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_add"])) {
            $nama_buah = $_POST["nama_buah"];
            $harga = $_POST["harga"];
            $stok = $_POST["stok"];

            $sql_insert_data = "INSERT INTO buah (nama_buah, harga, stok) VALUES ('$nama_buah', $harga, $stok)";
            if ($conn->query($sql_insert_data) === TRUE) {
                echo "<p>Data buah berhasil ditambahkan</p>";
            } else {
                echo "<p>Error: " . $conn->error . "</p>";
            }
        }

       
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_update"])) {
            $id_update = $_POST["id_update"];
            $harga_update = $_POST["harga_update"];
            $stok_update = $_POST["stok_update"];

            $sql_update_data = "UPDATE buah SET harga=$harga_update, stok=$stok_update WHERE id=$id_update";
            if ($conn->query($sql_update_data) === TRUE) {
                echo "<p>Data buah berhasil diperbarui</p>";
            } else {
                echo "<p>Error: " . $conn->error . "</p>";
            }
        }
        ?>

        <h2>Data Buah di Toko</h2>
        <?php
        // Retrieve and display data from the table
        $sql_select_data = "SELECT * FROM buah";
        $result = $conn->query($sql_select_data);

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>Nama Buah</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Action</th>
                    </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nama_buah']}</td>
                        <td>{$row['harga']}</td>
                        <td>{$row['stok']}</td>
                        <td>
                            <form method='post'>
                                <input type='hidden' name='id_update' value='{$row['id']}'>
                                <label for='harga_update'>Harga Baru:</label>
                                <input type='text' name='harga_update'>
                                <label for='stok_update'>Stok Baru:</label>
                                <input type='text' name='stok_update'>
                                <button type='submit' name='submit_update'>Update</button>
                            </form>
                        </td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No data available</p>";
        }
        ?>

        <h2>Tambah Data Buah Baru</h2>
        <form method="post">
            <label for="nama_buah">Nama Buah:</label>
            <input type="text" name="nama_buah" required>
            <label for="harga">Harga:</label>
            <input type="text" name="harga" required>
            <label for="stok">Stok:</label>
            <input type="text" name="stok" required>
            <button type="submit" name="submit_add">Tambah Data</button>
        </form>

        <?php
        // Close the connection
        $conn->close();
        ?>

        
    </div>
    <div class="bagian-buah">
    <img src="1.png" />
    <img src="2.png" />
    </div>
    
</body>
</html>
