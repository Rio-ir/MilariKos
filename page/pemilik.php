<?php

$update = ((isset($_GET['action']) AND $_GET['action'] == 'update') OR isset($_SESSION["is_logged"])) ? true : false;

if ($update) {
    $stmt = $connection->prepare("SELECT * FROM pemilik WHERE id_pemilik = ?");
    $stmt->bind_param("i", $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debug data dari form
    // var_dump($_POST); exit;

    // Validasi input
    $nama = $_POST['nama'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $telepon = $_POST['telepon'] ?? '';
    $email = $_POST['email'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($update) {
        if (!empty($password)) {
            $password_hash = md5($password);
            $sql = "UPDATE pemilik SET 
                        nama = ?, 
                        alamat = ?, 
                        telepon = ?, 
                        email = ?, 
                        username = ?, 
                        password = ?
                    WHERE id_pemilik = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("ssssssi", $nama, $alamat, $telepon, $email, $username, $password_hash, $_SESSION['id']);
        } else {
            $sql = "UPDATE pemilik SET 
                        nama = ?, 
                        alamat = ?, 
                        telepon = ?, 
                        email = ?, 
                        username = ?
                    WHERE id_pemilik = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("sssssi", $nama, $alamat, $telepon, $email, $username, $_SESSION['id']);
        }
    } else {
        $password_hash = md5($password);
        $sql = "INSERT INTO pemilik (nama, alamat, telepon, email, username, password) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssssss", $nama, $alamat, $telepon, $email, $username, $password_hash);
    }

    if ($stmt->execute()) {
        echo alert("Berhasil!", "?page=home");
    } else {
        echo alert("Gagal: " . $stmt->error, "?page=pemilik");
    }
}

if (isset($_GET['action']) AND $_GET['action'] == 'delete') {
    $stmt = $connection->prepare("DELETE FROM pemilik WHERE id_pemilik = ?");
    $stmt->bind_param("i", $_GET['key']);
    $stmt->execute();
    echo alert("Berhasil!", "?page=pemilik");
}
?>

<div class="container">

	<div class="page-header">
		<?php if ($update): ?>
			<h2>Update <small>data pemilik kost!</small></h2>
		<?php else: ?>
			<h2>Daftar <small>sebagai pemilik kost!</small></h2>
		<?php endif; ?>
	</div>
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
				<div class="form-group">
					<label for="nama">Nama</label>
					<input type="text" name="nama" class="form-control" autofocus="on" <?= (!$update) ?: 'value="'.$row["nama"].'"' ?>>
				</div>
				<div class="form-group">
					<label for="alamat">Alamat</label>
					<textarea rows="2" name="alamat" class="form-control"><?= (!$update) ? "" : $row["alamat"] ?></textarea>
				</div>
				<div class="form-group">
					<label for="telepon">No Telp</label>
					<input type="text" name="telepon" class="form-control" <?= (!$update) ?: 'value="'.$row["telepon"].'"' ?>>
				</div>
				<div class="form-group">
					<label for="email">email</label>
					<input type="email" name="email" class="form-control" <?= (!$update) ?: 'value="'.$row["email"].'"' ?>>
				</div>
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" name="username" class="form-control" <?= (!$update) ?: 'value="'.$row["username"].'"' ?>>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" class="form-control">
				</div>
				<?php if ($update): ?>
					<div class="row">
							<div class="col-md-10">
								<button type="submit" class="btn btn-warning btn-block">Update</button>
							</div>
							<div class="col-md-2">
								<a href="?page=kriteria" class="btn btn-default btn-block">Batal</a>
							</div>
					</div>
				<?php else: ?>
					<button type="submit" class="btn btn-primary btn-block">Register</button>
				<?php endif; ?>
		</form>
		</div>
		<div class="col-md-2"></div>
</div>

<script type="text/javascript">
$(function () {
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Pengunjung'
        },
        subtitle: {
            text: 'eKost Yogyakarta'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Rata-rata'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Total pengunjung <b>{point.y:.1f}</b>'
        },
        series: [{
            name: 'Population',
            data: [
							<?php
								$data = "";
								$sql = $connection->query("SELECT * FROM kost WHERE id_pemilik=$_SESSION[id]");
								while ($row = $sql->fetch_assoc()) {
									$data .= "['".$row["nama"]."', ".$row["pengunjung"]."],";
								}
								echo rtrim($data, ',');
							?>
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
</script>
