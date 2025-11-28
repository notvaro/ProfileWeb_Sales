<?php
include 'koneksi.php';

// Ambil semua data mahasiswa
$query = "SELECT nim, nama, foto, email, agama FROM biodata ORDER BY nim ASC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Profil Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .profile-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            padding: 40px 20px;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .profile-card {
            background: #243447;
            border-radius: 10px;
            padding: 25px;
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid #1b4965;
            cursor: pointer;
            text-decoration: none;
            color: #e8e8e8;
            display: block;
        }
        
        .profile-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(111, 170, 219, 0.3);
            border-color: #6faadb;
        }
        
        .profile-card img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #1b4965;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }
        
        .profile-card:hover img {
            border-color: #6faadb;
            transform: scale(1.1);
        }
        
        .profile-card h3 {
            color: #6faadb;
            font-size: 1.2em;
            margin-bottom: 8px;
        }
        
        .profile-card .nim {
            color: #90c9ff;
            font-size: 0.9em;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .profile-card .info {
            color: #d4e4f7;
            font-size: 0.85em;
            margin-top: 10px;
        }
        
        .header-title {
            text-align: center;
            padding: 40px 20px 20px;
            background: #0d1b2a;
            border-bottom: 3px solid #1b4965;
        }
        
        .header-title h1 {
            color: #6faadb;
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        
        .header-title p {
            color: #b0d4f1;
            font-size: 1.1em;
        }
        
        .admin-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #4CAF50;
            color: white;
            padding: 15px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.4);
            transition: all 0.3s ease;
            z-index: 1000;
        }
        
        .admin-button:hover {
            background: #45a049;
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.6);
        }
        
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #b0d4f1;
        }
        
        .empty-state h2 {
            color: #6faadb;
            margin-bottom: 20px;
        }
        
        .empty-state a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            background: #2196F3;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        
        .empty-state a:hover {
            background: #0b7dda;
        }
        
        @media (max-width: 768px) {
            .header-title h1 {
                font-size: 1.8em;
            }
            
            .profile-grid {
                grid-template-columns: 1fr;
                padding: 20px;
            }
            
            .admin-button {
                bottom: 20px;
                right: 20px;
                padding: 12px 20px;
                font-size: 0.9em;
            }
        }
    </style>
</head>
<body>
    <div class="header-title">
        <h1>🎓 Portal Profil Mahasiswa</h1>
        <p>Pilih profil mahasiswa yang ingin Anda lihat</p>
    </div>
    
    <div class="profile-grid">
        <?php if($result && mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <a href="index.php?nim=<?php echo urlencode($row['nim']); ?>" class="profile-card">
                    <img src="<?php echo htmlspecialchars($row['foto']); ?>" alt="Foto <?php echo htmlspecialchars($row['nama']); ?>">
                    <h3><?php echo htmlspecialchars($row['nama']); ?></h3>
                    <div class="nim">NIM: <?php echo htmlspecialchars($row['nim']); ?></div>
                    <div class="info">
                        <?php echo htmlspecialchars($row['agama']); ?><br>
                        <?php echo htmlspecialchars($row['email']); ?>
                    </div>
                </a>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="empty-state">
                <h2>📭 Belum Ada Profil</h2>
                <p>Belum ada data mahasiswa yang terdaftar.</p>
                <a href="admin.php?table=biodata">➕ Tambah Profil Pertama</a>
            </div>
        <?php endif; ?>
    </div>
    
    <a href="admin.php" class="admin-button">⚙️ Admin Panel</a>
    
    <footer style="background: #0d1b2a; color: #b0d4f1; text-align: center; padding: 20px; margin-top: 40px;">
        <p>Copyright 2025. All Rights Reserved</p>
    </footer>
</body>
</html>
