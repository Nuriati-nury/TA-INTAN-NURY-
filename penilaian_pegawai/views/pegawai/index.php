<?php

use app\models\Pegawai;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\PegawaiSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Daftar Pegawai';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="pegawai-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <br><br>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div style="overflow-x: auto; overflow-y: auto; max-height: 600px; max-width: 1900px;">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id_pegawai',
            'nama_pegawai',
            'nip_baru',
            'nip_lama',
            'jabatan',
            'email:email',
            'status',
            [
                'attribute' => 'user.status',
                'label' => 'Status User',
                'value' => function ($model) {
                    return $model->user->status == 10 ? 'Aktif' : 'Tidak Aktif';
                },

            ],
            'user.username',
            'user.role',
            'user.time_create',
            'user.time_update',
            [
            'class' => ActionColumn::className(),
            'template' => '{view} {update}', // hanya tampil View & Update, tanpa Delete
            'urlCreator' => function ($action, Pegawai $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id_pegawai' => $model->id_pegawai]);
            }
            ],

        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
