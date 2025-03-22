@extends('layouts/user')

@section('title', 'Tambah Alamat Saya')

@section('content')

<input id="search-box" type="text" placeholder="Cari lokasi..." style="width: 100%; padding: 10px;">
<div id="map" style="width: 100%; height: 400px;"></div>
<p><strong>Alamat Terpilih:</strong> <span id="selected-address">Belum ada lokasi yang dipilih</span></p>

<script>
    let map = L.map('map').setView([-6.200000, 106.816666], 15); // Jakarta

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    let marker = L.marker([-6.200000, 106.816666], { draggable: true }).addTo(map);

    function getAddress(lat, lon) {
        let url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`;
        fetch(url)
            .then(response => response.json())
            .then(data => {
                document.getElementById("selected-address").innerText = data.display_name || "Alamat tidak ditemukan";
            })
            .catch(() => {
                document.getElementById("selected-address").innerText = "Gagal mendapatkan alamat.";
            });
    }

    marker.on('dragend', function (event) {
        let position = event.target.getLatLng();
        getAddress(position.lat, position.lng);
    });

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                let userLocation = [position.coords.latitude, position.coords.longitude];
                map.setView(userLocation, 15);
                marker.setLatLng(userLocation);
                getAddress(position.coords.latitude, position.coords.longitude);
            },
            () => alert("Gagal mendapatkan lokasi.")
        );
    }
</script>



@endsection
