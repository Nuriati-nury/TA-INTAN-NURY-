<?php

use app\models\Penilaian;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\PenilaianSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Daftar Penilaian';
// $this->params['breadcrumbs'][] = $this->title;
?>

<div class="penilaian-index">


    <h1><?= Html::encode($this->title) ?></h1>
    <br>
 <div style="overflow-x: auto; overflow-y: auto; max-height: 650px;">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_penilaian',
            // menampilkan nama pegawai dinilai
            
            [
                'attribute' => 'nama_pegawai',
                'value' => function($model) {
                    return $model->pegawaiDinilai ? $model->pegawaiDinilai->nama_pegawai : '(not set)';
                },
                'label' => 'Nama Pegawai Dinilai',
            ],

            'tahun',
            // Ubah kolom periode menjadi nama bulan
            [
                'attribute' => 'nama_bulan',
                'value' => function ($model) {
                    return $model->getNamaBulan();
                },
                'label' => 'Periode',
            ],

            [
                'attribute' => 'q1',
                'label' => 'P1',
            ],

           [
                'attribute' => 'q2',
                'label' => 'P2',
            ],

            [
                'attribute' => 'q3',
                'label' => 'P3',
            ],

            [
                'attribute' => 'q4',
                'label' => 'P4',
            ],

            [
                'attribute' => 'q5',
                'label' => 'P5',
            ],
           [
                'attribute' => 'q6',
                'label' => 'P6',
            ],
            [
                'attribute' => 'q7',
                'label' => 'P7',
            ],
           [
                'attribute' => 'q8',
                'label' => 'P8',
            ],
            [
                'attribute' => 'q9',
                'label' => 'P9',
            ],
           [
                'attribute' => 'q10',
                'label' => 'P10',
            ],
            [
                'attribute' => 'q11',
                'label' => 'P11',
            ],
            // 'tanggal_submit',
            'skor',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Penilaian $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_penilaian' => $model->id_penilaian]);
                 }
                 ,
                 'template' => '{view}', // Menampilkan hanya tombol view



            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
