<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Penilaian $model */

$this->title = 'Create Penilaian';
// $this->params['breadcrumbs'][] = ['label' => 'Penilaians', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="penilaian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'nama_pegawai' => $nama_pegawai,
    ]) ?>
</div>
