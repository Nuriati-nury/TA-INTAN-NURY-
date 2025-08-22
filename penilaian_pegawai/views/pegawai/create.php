<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pegawai $model */

$this->title = 'Tambah Pegawai';
// $this->params['breadcrumbs'][] = ['label' => 'Pegawai', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="pegawai-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <br><br>
    
    <?= $this->render('_formgabung', [
        'model' => $model,
        'modelUser' => $modelUser,
    ]) ?>

</div>
