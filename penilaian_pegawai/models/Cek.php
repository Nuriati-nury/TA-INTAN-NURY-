<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pegawai".
 *
 * @property int $id_pegawai
 * @property string $nama_pegawai
 * @property string $nip
 * @property string $jabatan
 * @property string $email
 *
 * @property Penilaian[] $penilaians
 */
class Cek extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cek';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_cek_penilaian'], 'required'],
            [['kode_cek_penilaian'], 'integer'],
            [['kode_cek_penilaian'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode_cek_penilaian' => 'Kode Cek Penilaian',
        ];
    }

    /**
     * Gets query for [[Penilaians]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPenilaian()
    {
        return $this->hasMany(Penilaian::class, ['kode_penilaian' => 'kode_cek_penilaian']);
    }
}
