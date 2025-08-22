<?php
$this->title = 'Home';
use yii\helpers\Html;

$url = Yii::getAlias("@web") . '/images/';
?>

<div class="container-fluid"  
    style="background:url(<?= $url ?>background.jpeg); 
    background-repeat:no-repeat; 
    background-position:center top;
    -webkit-background-size:cover; 
    position: absolute;
    top: 0;
    bottom: 40;
    left: 0;
    right: 0;
    min-height: 100vh; ">

    <!-- Judul Selamat Datang -->
    <h1 class="text-center" style="margin-top:120px; color:white;">
        <b>Selamat Datang <br> <?= $pegawai->nama_pegawai; ?>!</b>
    </h1>

    <!-- Grafik Pegawai Terbaik -->
    <h2 class="text-center" style="margin-top:40px; color:white;">
        Pegawai Terbaik Per Bulan
    </h2>
    <div style="width:90%; max-width:800px; margin:30px auto; background:white; padding:20px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.3);">
        <canvas id="pegawaiChart"></canvas>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('pegawaiChart').getContext('2d');

    const labels = <?= json_encode(array_map(function($row) {
        return $row['nama_pegawai'] . " (" . $row['bulan'] . "-" . $row['tahun'] . ")";
    }, $grafikData)) ?>;

    const nilai = <?= json_encode(array_column($grafikData, 'total_skor')) ?>;

    // warna acak untuk setiap bulan
    const backgroundColors = labels.map((_, i) => {
        const colors = [
            'rgba(255, 99, 132, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 206, 86, 0.7)',
            'rgba(75, 192, 192, 0.7)',
            'rgba(153, 102, 255, 0.7)',
            'rgba(255, 159, 64, 0.7)',
            'rgba(199, 199, 199, 0.7)',
            'rgba(255, 99, 71, 0.7)',
            'rgba(60, 179, 113, 0.7)',
            'rgba(123, 104, 238, 0.7)',
            'rgba(0, 191, 255, 0.7)',
            'rgba(220, 20, 60, 0.7)'
        ];
        return colors[i % colors.length];
    });

    const borderColors = backgroundColors.map(c => c.replace("0.7", "1"));

    new Chart(ctx, {
        type: 'bar', // lebih cocok bar biar tiap bulan warnanya beda
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Skor Pegawai Terbaik',
                data: nilai,
                backgroundColor: backgroundColors,
                borderColor: borderColors,
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + " - Skor: " + context.formattedValue;
                        }
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        maxRotation: 45, // miringkan tulisan
                        minRotation: 45,
                        autoSkip: false, // biar semua label tetap ditampilkan
                        font: {
                            size: 12,
                            family: "Arial"
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Skor',
                        font: { size: 14 }
                    }
                }
            }
        }
    });
</script>
