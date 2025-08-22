<?php

use app\models\Pegawai;
use app\models\Penilaian;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\DataColumn;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
/** @var yii\web\View $this */
/** @var app\models\PenilaianSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Daftar Penilaian';
// $this->params['breadcrumbs'][] = $this->title;
?>
 
<div class="penilaian-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div style="padding: 20px;">
        <b>
            <div class="row">
                <div class="col-md-3">
                    Nama Pegawai Penilai
                </div>
                <div class="col-md-9">
                    : &nbsp; <?= $pegawai_penilai->nama_pegawai; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Bulan
                </div>
                <div class="col-md-9">
                    : &nbsp; <?= $bulan->nama_bulan; ?>
                </div>
            </div>
        </b>
    </div>
    <br>
    <div style="overflow-x: auto; overflow-y: auto;  max-height: 530px;">



    <?php Pjax::begin(['enablePushState' => false, 'timeout' => 8000]); ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=


    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // [
            //     'attribute' => 'kode_penilaian',
            //     'value'=> 'penilaians.id_pegawai_dinilai',
            // ],
            [
                'attribute' => 'nama_pegawai',
                'label' => 'Nama Pegawai',
            ],


            // 'kode_penilaian',

            // if ()
            // Kolom status penilaian
            [
                'label' => 'Status',
                'format' => 'raw',
                'value' => function ($model) {
                    $idUser = Yii::$app->user->id;
                    $penilai = User::findOne($idUser);
                    $idPenilai = $penilai->id_pegawai;
            
                    // Ambil bulan dan tahun saat ini
                    $bulanSekarang = date('m');
                    $tahunSekarang = date('Y');
            
                    // Log info untuk debug (opsional)
                    Yii::info("Cek status penilaian untuk Pegawai ID: {$model->id_pegawai}, Bulan: {$bulanSekarang}, Tahun: {$tahunSekarang}", 'debug');
            
                    // Cek apakah sudah ada penilaian di bulan dan tahun sekarang
                    $penilaian = Penilaian::find()
                        ->where([
                            'id_pegawai_dinilai' => $model->id_pegawai,
                            'id_pegawai_penilai' => $idPenilai,
                            'periode' => $bulanSekarang,
                            'tahun' => $tahunSekarang,
                        ])
                        ->one();
            
                    if ($penilaian) {
                        return '<span class="badge bg-success">Sukses</span>';
                    } else {
                        return '<span class="badge bg-warning text-dark">Belum Dinilai</span>';
                    }
                },
            ],
            
            


            [
                'header' => 'Aksi',
                'class' => ActionColumn::className(),
                // 'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                // 'buttons' => [
                //     'update' => function($url, $model){
                //         $url = Yii::$app->urlManager->createUrl(['penilaian/create']);
                //         return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url, ['title' => 'Beri Nilai']);
                //     }
                // ],
                'urlCreator' => function ($action, Pegawai $model, $key, $index, $column) {
                    return Url::toRoute(['penilaian/nilai-pegawai', 'id' => $model->id_pegawai]);
                 }, 
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
