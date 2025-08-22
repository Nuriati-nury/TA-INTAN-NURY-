<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Penilaian $model */

$this->title = $model->id_penilaian;
// $this->params['breadcrumbs'][] = ['label' => 'Penilaians', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="penilaian-view">

    <h1><?= Html::encode($this->title) ?></h1>

  <!--   <p>
        <?= Html::a('Update', ['update', 'id_penilaian' => $model->id_penilaian], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_penilaian' => $model->id_penilaian], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->
    <div style="overflow-x: auto; overflow-y: auto; max-height: 660px; max-width: 1900px;">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_penilaian',
             // menampilkan nama pegawai dinilai
             [
            'attribute' => 'id_pegawai_dinilai',
            'value' => function($model) {
                return $model->pegawaiDinilai ? $model->pegawaiDinilai->nama_pegawai : '(not set)';
            },
            'label' => 'Nama Pegawai Dinilai',
            ],

            'id_pegawai_penilai',
            
            'tahun',
            // Ubah kolom periode menjadi nama bulan
            [
                'attribute' => 'periode',
                'value' => function ($model) {
                    return $model->getNamaBulan();
                },
            ],
            'q1',
            'q2',
            'q3',
            'q4',
            'q5',
            'q6',
            'q7',
            'q8',
            'q9',
            'q10',
            'q11',
            'tanggal_submit',
            'skor',
        ],
    ]) ?>

</div>
