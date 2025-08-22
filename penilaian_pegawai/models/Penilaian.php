<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "penilaian".
 *
 * @property int $id_penilaian
 * @property int $id_pegawai_dinilai
 * @property string $periode
 * @property int $q1
 * @property int $q2
 * @property int $q3
 * @property int $q4
 * @property int $q5
 * @property int $q6
 * @property int $q7
 * @property int $q8
 * @property int $q9
 * @property int $q10
 * @property int $q11
 * @property string $tanggal_submit
 * @property int $skor
 *
 * @property Pegawai $pegawai
 */
class Penilaian extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penilaian';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
             [['id_pegawai_dinilai', 'periode', 'kode_penilaian', 'q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 'q10', 'q11'], 'required', 'message' => 'Belum Mengisi {attribute}'],
            [['id_pegawai_dinilai', 'id_pegawai_penilai', 'periode', 'kode_penilaian', 'q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 'q10', 'q11', 'skor'], 'integer'],
            [['tanggal_submit'], 'safe'],
            [['id_pegawai_penilai','skor'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::class, 'targetAttribute' => ['id_pegawai_dinilai' => 'id_pegawai']],
        ];
    }

    public function calculateTotalScore()
    {
        $this->skor = $this->q1 + $this->q2 + $this->q3 + $this->q4 + $this->q5 + $this->q6 + $this->q7 + $this->q8 + $this->q9 + $this->q10 + $this->q11;
        return $this->skor;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_penilaian' => 'Id Penilaian',
            'id_pegawai_dinilai' => 'Nama Pegawai Dinilai',
            'nama_pegawai' => 'Nama Pegawai',
            'id_pegawai_penilai' => 'Nama Pegawai Penilai',
            'periode' => 'Periode',
            'kode_penilaian' => 'Kode Penilaian',
            'q1' => 'Pertanyaan 1',
            'q2' => 'Pertanyaan 2',
            'q3' => 'Pertanyaan 3',
            'q4' => 'Pertanyaan 4',
            'q5' => 'Pertanyaan 5',
            'q6' => 'Pertanyaan 6',
            'q7' => 'Pertanyaan 7',
            'q8' => 'Pertanyaan 8',
            'q9' => 'Pertanyaan 9',
            'q10' => 'Pertanyaan 10',
            'q11' => 'Pertanyaan 11',
            'tanggal_submit' => 'Tanggal Submit',
            'skor' => 'Skor',
        ];
    }

    /**
     * Gets query for [[Pegawai]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPegawaiDinilai()
    {
        return $this->hasOne(Pegawai::class, ['id_pegawai' => 'id_pegawai_dinilai']);
    }

    public function getPegawaiPenilai()
    {
        return $this->hasOne(Pegawai::class, ['id_pegawai' => 'id_pegawai_penilai']);
    }

    public function getBulan()
    {
        return $this->hasOne(Bulan::class, ['id_bulan' => 'periode']);
    }

    public function getCekPenilaian()
    {
        return $this->hasOne(Cek::class, ['kode_cek_penilaian' => 'kode_penilaian']);
    }

    public static function getAllPegawai()
{
    $pegawai = Pegawai::find()
        ->joinWith('user') // relasi ke tabel user (sudah ada di Pegawai.php)
        ->where(['user.status' => 10]) // hanya ambil pegawai yang user-nya aktif
        ->all();

    return \yii\helpers\ArrayHelper::map($pegawai, 'id_pegawai', 'nama_pegawai');
}


    public function getNamaBulan()
    {
        $bulanArray = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        return $bulanArray[$this->periode] ?? 'Tidak Diketahui';
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Jika tahun belum diisi, set otomatis dengan tahun saat ini
            if (empty($this->tahun)) {
                $this->tahun = date('Y'); // Mengambil tahun saat ini
            }
            return true;
        }
        return false;
    }

    public function getPegawai()
{
    return $this->hasOne(Pegawai::className(),['id_pegawai' => 'id_pegawai'])
                ->andOnCondition(['pegawai.status' => 10]);
}

public static function getEvaluasiByPegawai($idPegawai, $periode, $tahun)
{
    $query = (new \yii\db\Query())
        ->select([
            'AVG(q1) AS q1',
            'AVG(q2) AS q2',
            'AVG(q3) AS q3',
            'AVG(q4) AS q4',
            'AVG(q5) AS q5',
            'AVG(q6) AS q6',
            'AVG(q7) AS q7',
            'AVG(q8) AS q8',
            'AVG(q9) AS q9',
            'AVG(q10) AS q10',
            'AVG(q11) AS q11',
            'COUNT(DISTINCT id_pegawai_penilai) AS jumlah_penilai',
        ])
        ->from('penilaian')
        ->where([
            'id_pegawai_dinilai' => $idPegawai,
            'periode' => $periode,
            'tahun' => $tahun,
        ]);

    return $query->one();
}


}
