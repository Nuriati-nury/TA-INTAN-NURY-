<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pegawai $model */

$this->title = 'Update Pegawai: ' . $model->nama_pegawai;
// $this->params['breadcrumbs'][] = ['label' => 'Pegawai', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id_pegawai, 'url' => ['view', 'id_pegawai' => $model->id_pegawai]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="pegawai-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <br><br>

    <?= $this->render('_formgabung', [
        'model' => $model,
        'modelUser' => $modelUser,
    ]) ?>

</div>
