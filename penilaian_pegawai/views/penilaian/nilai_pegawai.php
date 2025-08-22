<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Penilaian $model */

$this->title = 'Penilaian Pegawai Terbaik';
// $this->params['breadcrumbs'][] = ['label' => 'Penilaians', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-create" style="padding: 30px;">

    

    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    <?= $this->render('_form2', [
        'model' => $model,
        'nama_pegawai' => $nama_pegawai,
        'pegawai_dinilai' => $pegawai_dinilai,
        'bulan' => $bulan,
    ]) ?>
</div>
