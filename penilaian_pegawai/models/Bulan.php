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
class Bulan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bulan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_bulan', 'nama_bulan'], 'required'],
            [['nama_bulan'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_bulan' => 'Id Bulan',
            'nama_bulan' => 'Nama Bulan',
        ];
    }

    /**
     * Gets query for [[Penilaians]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPenilaian()
    {
        return $this->hasMany(Penilaian::class, ['periode' => 'id_bulan']);
    }
}
