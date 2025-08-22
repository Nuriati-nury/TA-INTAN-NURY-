<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Penilaian $model */

$this->title = 'Update Penilaian: ' . $model->id_penilaian;
// $this->params['breadcrumbs'][] = ['label' => 'Penilaians', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id_penilaian, 'url' => ['view', 'id_penilaian' => $model->id_penilaian]];
// $this->params['breadcrumbs'][] = 'Update';
?>
<div class="penilaian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
