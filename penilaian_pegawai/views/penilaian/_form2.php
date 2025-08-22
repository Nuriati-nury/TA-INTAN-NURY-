<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Pegawai;
use app\models\Penilaian;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var app\models\Penilaian $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="penilaian-form">

    <?php $form = ActiveForm::begin(); ?>


    <div style="padding: 20px;">
        <b>
            <div class="row">
                <div class="col-md-2">
                    Nama Pegawai 
                </div>
                <div class="col-md-10">
                    : &nbsp; <?= $pegawai_dinilai->nama_pegawai; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    Bulan
                </div>
                <div class="col-md-10">
                    : &nbsp; <?= $bulan->nama_bulan; ?>
                </div>
            </div>
        </b>
    </div>
    
    <br>
    <div style="overflow-x: auto; overflow-y: auto;  max-height: 600px;">

    <table class="table table-bordered">
    <thead>
        <tr>
            <th class="col-md-1">No</th>
            <th class="col-md-4">Pertanyaan</th>
            <th>Jawaban</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="col-md-1">1</td>
            <td class="col-md-4">Memakai seragam sesuai hari yang ditentukan</td>
            <td>
                <div style="display: grid; grid-auto-flow: column; grid-column-gap: 10px;">
                <?= $form->field($model, 'q1')->radioList([1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10'],
                    array( 'separator' =>  ' &nbsp&nbsp&nbsp&nbsp'))->label(false); ?>
                    <div class="help-block">
                    <?= Html::error($model, 'q1') ?>
                    </div>

                </div>
            </td>
        </tr>
        <tr>
            <td class="col-md-1">2</td>
            <td class="col-md-4">Bekerja di saat jam kantor</td>
            <td><?= $form->field($model, 'q2')->radioList([1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10'],
                    array( 'separator' =>  ' &nbsp&nbsp&nbsp&nbsp'))->label(false); ?></td>
        </tr>
        <tr>
            <td class="col-md-1">3</td>
            <td class="col-md-4">Kembali ke kantor setelah istirahat siang</td>
            <td><?= $form->field($model, 'q3')->radioList([1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10'],
                    array( 'separator' =>  ' &nbsp&nbsp&nbsp&nbsp'))->label(false); ?></td>
        </tr>
        <tr>
            <td class="col-md-1">4</td>
            <td class="col-md-4">Terbiasa memberikan hasil kerja dengan kualitas yang tinggi</td>
            <td><?= $form->field($model, 'q4')->radioList([1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10'],
                    array( 'separator' =>  ' &nbsp&nbsp&nbsp&nbsp'))->label(false); ?></td>
        </tr>
        <tr>
            <td class="col-md-1">5</td>
            <td class="col-md-4">Menyegerakan penyelesaian masalah dan fokus pada langkah-langkah perbaikan</td>
            <td><?= $form->field($model, 'q5')->radioList([1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10'],
                    array( 'separator' =>  ' &nbsp&nbsp&nbsp&nbsp'))->label(false); ?></td>
        </tr>
        <tr>
            <td class="col-md-1">6</td>
            <td class="col-md-4">Menyemangati dan mempertahankan suasana kerja yang harmonis dan sinergis antar pegawai</td>
            <td><?= $form->field($model, 'q6')->radioList([1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10'],
                    array( 'separator' =>  ' &nbsp&nbsp&nbsp&nbsp'))->label(false); ?></td>
        </tr>
        <tr>
            <td class="col-md-1">7</td>
            <td class="col-md-4">Mendahulukan kepentingan organisasi di atas kepentingan pribadi</td>
            <td><?= $form->field($model, 'q7')->radioList([1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10'],
                    array( 'separator' =>  ' &nbsp&nbsp&nbsp&nbsp'))->label(false); ?></td>
        </tr>
        <tr>
            <td class="col-md-1">8</td>
            <td class="col-md-4">Menyebarluaskan informasi tentang kesuksesan pegawai dalam melaksanakan tugas yang diberikan</td>
            <td><?= $form->field($model, 'q8')->radioList([1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10'],
                    array( 'separator' =>  ' &nbsp&nbsp&nbsp&nbsp'))->label(false); ?></td>
        </tr>
        <tr>
            <td class="col-md-1">9</td>
            <td class="col-md-4">Memiliki kejujuran dan integritas dalam melaksanakan pekerjaannya</td>
            <td><?= $form->field($model, 'q9')->radioList([1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10'],
                    array( 'separator' =>  ' &nbsp&nbsp&nbsp&nbsp'))->label(false); ?></td>
        </tr>
        <tr>
            <td class="col-md-1">10</td>
            <td class="col-md-4">Telah memberikan kontribusi yang signifikan dalam mencapai tujuan tim</td>
            <td><?= $form->field($model, 'q10')->radioList([1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10'],
                    array( 'separator' =>  ' &nbsp&nbsp&nbsp&nbsp'))->label(false); ?></td>
        </tr>
        <tr>
            <td class="col-md-1">11</td>
            <td class="col-md-4">Memiliki tanda-tanda perubahan positif dalam keterampilan atau perilaku sejak penilaian sebelumnya</td>
            <td><?= $form->field($model, 'q11')->radioList([1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10'],
                    array( 'separator' =>  ' &nbsp&nbsp&nbsp&nbsp'))->label(false); ?></td>
        </tr>
        <!-- <tr>
            <td>Tanggal Submit</td>
            <td><?= $form->field($model, 'tanggal_submit')->textInput()->label(false); ?></td>
        </tr> -->
        <!-- <tr>
            <td>Skor</td>
            <td><?= $form->field($model, 'skor')->textInput()->label(false); ?></td>
        </tr> -->
    </tbody>
</table>

    <div class="form-group" style="text-align: center;">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
