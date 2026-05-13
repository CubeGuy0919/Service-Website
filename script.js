document.addEventListener('DOMContentLoaded', () => {
    fetch('get_data.php')
        .then(response => response.json())
        .then(data => {
            const lista = document.getElementById('termek-lista');
            lista.innerHTML = data.map(item => `
                <tr>
                    <td><a href="#" class="kat-link">${item.kategoria}</a></td>
                    <td>
                        <a href="#" class="termek-nev">${item.nev}</a>
                        <span class="reszletek">${item.leiras}</span>
                    </td>
                    <td style="color:var(--zold); font-weight:bold;">${item.ar.toLocaleString()} Ft</td>
                    <td>${item.bolt}</td>
                    <td><button class="buy-btn">Hozzáadás</button></td>
                </tr>
            `).join('');
        });
});