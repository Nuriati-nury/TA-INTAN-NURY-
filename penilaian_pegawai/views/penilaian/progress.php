<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var array $progressList */
/** @var int $bulan */
/** @var int $tahun */

$this->title = "Progress Penilaian";
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="progress-filter" style="margin-bottom:20px;">
    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => ['penilaian/progress'],
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
        <div class="col-md-2">
            <?= Html::submitButton('Cari', ['class'=>'btn btn-primary']) ?>
            <?= Html::a('Reset', ['penilaian/progress'], ['class'=>'btn btn-outline-secondary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<h3>Progress Penilaian Bulan <?= Html::encode($bulan) ?> - <?= Html::encode($tahun) ?></h3>

<table class="table table-bordered table-striped">
    <thead style="background:#f0f0f0;">
        <tr>
            <th>No</th>
            <th>Nama Pegawai (Penilai)</th>
            <th>Progress Penilaian</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($progressList as $i => $row): ?>
            <tr>
                <td><?= $i+1 ?></td>
                <td><?= Html::encode($row['nama_pegawai']) ?></td>
                <td><?= Html::encode($row['progress']) ?></td>
                <td><?= $row['status'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
