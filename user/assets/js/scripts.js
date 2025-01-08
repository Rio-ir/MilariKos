document.getElementById('searchForm').addEventListener('submit', function (event) {
    event.preventDefault();

    const formData = new FormData(this);
    const query = new URLSearchParams(formData).toString();

    fetch(`/api/search.php?${query}`)
        .then(response => response.json())
        .then(data => {
            const results = document.getElementById('results');
            if (data.length > 0) {
                results.innerHTML = data.map(kos => `
                    <div style="border: 1px solid #ddd; padding: 10px; margin-bottom: 10px;">
                        <h3>${kos.nama}</h3>
                        <p>${kos.alamat}</p>
                        <p>Harga: Rp ${parseInt(kos.harga_3bulan).toLocaleString()}</p>
                        <p>Fasilitas: ${kos.fasilitas}</p>
                        <a href="/pages/detail.php?id=${kos.id_kost}">Detail</a>
                    </div>
                `).join('');
            } else {
                results.innerHTML = '<p>Tidak ada kos yang ditemukan.</p>';
            }
        })
        .catch(err => {
            console.error(err);
            results.innerHTML = '<p>Terjadi kesalahan saat mengambil data.</p>';
        });
});
