<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>PC Szerviz - JSON Alapú Gépépítő</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar">
    <div class="logo">PC <span>SZERVIZ</span></div>
    <div class="nav-links">
        <a href="#">Gépépítő</a>
        <a href="#">Összeállítások</a>
        <a href="#">Útmutatók</a>
    </div>
</nav>

<div class="container">
    <header class="hero">
        <h1>Válassz alkatrészt a gépedhez</h1>
        <p>JSON adatbázisból betöltött, naprakész árak és specifikációk.</p>
    </header>

    <div class="comp-bar">
        <span>✔</span> Kompatibilitás: Minden alkatrész megfelelően együttműködik.
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Kategória</th>
                    <th>Termék megnevezése</th>
                    <th>Ár (HUF)</th>
                    <th>Művelet</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // JSON fájl beolvasása
                $json_adat = file_get_contents('termekek.json');
                $termekek = json_decode($json_adat, true);

                if ($termekek) {
                    foreach ($termekek as $item) {
                        ?>
                        <tr>
                            <td><a href="#" class="cat-link"><?php echo $item['kategoria']; ?></a></td>
                            <td>
                                <span class="prod-name"><?php echo $item['nev']; ?></span>
                                <span class="prod-details"><?php echo $item['leiras']; ?></span>
                            </td>
                            <td class="price"><?php echo number_format($item['ar'], 0, ',', ' '); ?> Ft</td>
                            <td><button class="btn-add">Hozzáadás</button></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='4'>Hiba a JSON betöltésekor!</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

/* TEST */
</body>
</html>