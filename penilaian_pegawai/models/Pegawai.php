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
class Pegawai extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pegawai';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_pegawai', 'nip_baru', 'nip_lama', 'jabatan', 'status', 'email'], 'required','message' => 'Belum Mengisi {attribute}'],
            [['nama_pegawai','nip_baru', 'nip_lama', 'jabatan', 'status', 'email'], 'string', 'max' => 255],
            ['email', 'email', 'message' => 'Format email tidak valid.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pegawai' => 'Id Pegawai',
            'nama_pegawai' => 'Nama Pegawai',
            'nip_baru' => 'NIP Baru',
            'nip_lama' => 'NIP Lama',
            'jabatan' => 'Jabatan',
            'status' => 'Status Pegawai',
            'email' => 'Email',
            'role' => 'role',
        ];
    }

    /**
     * Gets query for [[Penilaians]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPenilaiansDinilai()
    {
        return $this->hasMany(Penilaian::class, ['id_pegawai_dinilai' => 'id_pegawai']);
    }

    public function getPenilaiansPenilai()
    {
        return $this->hasMany(Penilaian::class, ['id_pegawai_penilai' => 'id_pegawai']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id_pegawai' => 'id_pegawai']);
    }

}
