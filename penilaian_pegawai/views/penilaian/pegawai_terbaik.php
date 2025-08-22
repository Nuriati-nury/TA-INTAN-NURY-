<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\RekapitulasiSearch $searchModel */
/** @var yii\data\ArrayDataProvider $dataProvider */

$this->title = 'Pegawai Terbaik';
?>

<div class="pegawai-terbaik-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div style="overflow-x: auto; overflow-y: auto; max-height: 650px;">
    <br><br><br>
        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'action' => ['pegawai-terbaik'], // diarahkan ke pegawai terbaik
        ]); ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($searchModel, 'bulan')->dropDownList(
                $searchModel->getBulanList(), 
                ['prompt' => 'Pilih Bulan']
            ) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($searchModel, 'tahun')->input('number', [
                'min' => 2000,
                'max' => date('Y'),
                'value' => date('Y'),
                'placeholder' => 'Cari tahun'
            ]) ?>
        </div>
    </div>

        <div class="form-group">
            <?= Html::submitButton('Cari', ['class' => 'btn btn-primary']) ?>
             <?= Html::a('Reset', ['pegawai-terbaik'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        <br>

        <?php if ($dataProvider->getTotalCount() === 0): ?>
            <p>Data belum ada.</p>
        <?php else: ?>
        <p>
            <?= Html::a('Export Excel', ['export-excel-pegawai-terbaik'], ['class' => 'btn btn-success']) ?>
        </p>



            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'tahun',
                    'bulan',
                    'nama_pegawai',
                    'total_skor',
                ],
            ]); ?>
        <?php endif; ?>
    </div>
</div>
