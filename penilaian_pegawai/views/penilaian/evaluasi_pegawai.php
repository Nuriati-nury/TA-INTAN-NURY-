<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var array $evaluasi */
/** @var int $bulan */
/** @var int $tahun */

$this->title = "Evaluasi Pegawai";

// daftar pertanyaan langsung di array (bisa kamu ganti sesuai kebutuhan)
$pertanyaanList = [
    1 => "Memakai seragam sesuai hari yang ditentukan",
    2 => "Bekerja di saat jam kantor",
    3 => "Kembali ke kantor setelah istirahat siang",
    4 => "Terbiasa memberikan hasil kerja dengan kualitas yang tinggi",
    5 => "Menyegerakan penyelesaian masalah dan fokus pada langkah-langkah perbaikan",
    6 => "Menyemangati dan mempertahankan suasana kerja yang harmonis dan sinergis antar pegawai",
    7 => "Mendahulukan kepentingan organisasi di atas kepentingan pribadi",
    8 => "Menyebarluaskan informasi tentang kesuksesan pegawai dalam melaksanakan tugas yang diberikan",
    9 => "Memiliki kejujuran dan integritas dalam melaksanakan pekerjaannya",
    10 => "Telah memberikan kontribusi yang signifikan dalam mencapai tujuan tim",
    11 => "Memiliki tanda-tanda perubahan positif dalam keterampilan atau perilaku sejak penilaian sebelumnya",
];
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="evaluasi-filter" style="margin-bottom:20px;">
    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => ['penilaian/evaluasi-pegawai'],
    ]); ?>

    <div class="row">
        <div class="col-md-3">
            <?= Html::dropDownList('bulan', $bulan, [
                1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April',
                5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus',
                9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'
            ], ['class'=>'form-control', 'prompt'=>'Pilih Bulan']) ?>
        </div>
        <div class="col-md-2">
            <?= Html::input('number', 'tahun', $tahun, [
                'class'=>'form-control',
                'min'=>2000,
                'max'=>date('Y'),
                'placeholder'=>'Tahun'
            ]) ?>
        </div>
    </div>
    <p>
    <div class="form-group">
            <?= Html::submitButton('Cari', ['class'=>'btn btn-primary']) ?>
            <?= Html::a('Reset', ['penilaian/evaluasi-pegawai'], ['class'=>'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php if (empty($evaluasi) || $evaluasi['jumlah_penilai'] == 0): ?>
    <p>Belum ada penilaian untuk periode ini.</p>
<?php else: ?>
    <table class="table table-bordered table-striped">
        <thead style="background:#f0f0f0;">
            <tr>
                <th>No</th>
                <th>Pertanyaan</th>
                <th>Persentase</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 1; $i <= 11; $i++): ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $pertanyaanList[$i] ?></td>
                    <td><?= round(($evaluasi["q$i"] / 10) * 100, 2) ?>%</td>
                </tr>
            <?php endfor; ?>
            <tr>
                <td colspan="3"><b>Jumlah Penilai: <?= $evaluasi['jumlah_penilai'] ?></b></td>
            </tr>
        </tbody>
    </table>
<?php endif; ?>
