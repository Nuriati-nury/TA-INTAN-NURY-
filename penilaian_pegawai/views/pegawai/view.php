<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Pegawai $model */

$this->title = $model->nama_pegawai;
// $this->params['breadcrumbs'][] = ['label' => 'Pegawai', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pegawai-view">


    <h1><?= Html::encode($this->title) ?></h1>
    <div style="overflow-x: auto; overflow-y: auto; max-height: 420px; max-width: 1200px;">
    <br>
    
    <p style="text-align: right;">
        <?= Html::a('Update', ['update', 'id_pegawai' => $model->id_pegawai], ['class' => 'btn btn-primary']) ?>
    </p>
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id_pegawai',
            'nama_pegawai',
            'nip_baru',
            'nip_lama',
            'jabatan',
            'status',
            'email:email',
            'user.username',
            'user.password',
             [
                'attribute' => 'user.status',
                'label' => 'Status User',
                'value' => function ($model) {
                    return $model->user->status == 10 ? 'Aktif' : 'Tidak Aktif';
                },

            ],
            'user.role',
            'user.time_create',
            'user.time_update'
        ],
    ]) ?>

</div>
