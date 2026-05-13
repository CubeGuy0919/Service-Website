<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>PC Szerviz - Gépépítő</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar">
    <div class="logo">PC <span>SZERVIZ</span></div>
    <button class="btn-add" style="background:transparent; border:1px solid #555;">Bejelentkezés</button>
</nav>

<div class="container">
    <div class="comp-bar">
        <span>✔</span> Kompatibilitás: Minden alkatrész megfelelően együttműködik.
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Kategória</th>
                    <th>Termék kiválasztása</th>
                    <th>Ár</th>
                    <th>Művelet</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM termekek LIMIT 20";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><a href="#" class="cat-link"><?php echo $row['kategoria']; ?></a></td>
                            <td>
                                <span class="prod-name"><?php echo $row['nev']; ?></span>
                                <span class="prod-details"><?php echo $row['leiras']; ?></span>
                            </td>
                            <td class="price"><?php echo number_format($row['ar'], 0, ',', ' '); ?> Ft</td>
                            <td><button class="btn-add">Hozzáadás</button></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='4'>Nincs adat az adatbázisban.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>