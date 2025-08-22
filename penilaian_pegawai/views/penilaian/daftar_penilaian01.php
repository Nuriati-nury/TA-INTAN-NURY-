<?php

use app\models\Pegawai;
use app\models\Penilaian;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\DataColumn;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\PenilaianSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

// $this->title = 'Penilaians';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
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
            'nama_pegawai',
            // 'kode_penilaian',

            // if ()
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
