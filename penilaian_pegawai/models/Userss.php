<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 * @property int $status
 * @property string $role
 * @property int $id_pegawai
 * @property string $time_create
 * @property string $time_update
 *
 * @property Pegawai $pegawai
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'authKey', 'accessToken', 'status', 'role', 'id_pegawai', 'time_create', 'time_update'], 'required','message' => 'Belum Mengisi {attribute}'],
            [['status', 'id_pegawai'], 'integer'],
            [['time_create', 'time_update'], 'safe'],
            [['username', 'password', 'authKey', 'accessToken'], 'string', 'max' => 255],
            [['role'], 'string', 'max' => 60],
            [['id_pegawai'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::class, 'targetAttribute' => ['id_pegawai' => 'id_pegawai']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'status' => 'Status',
            'role' => 'Role',
            'id_pegawai' => 'Id Pegawai',
            'time_create' => 'Time Create',
            'time_update' => 'Time Update',
        ];
    }

    /**
     * Gets query for [[Pegawai]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPegawai()
    {
        return $this->hasOne(Pegawai::class, ['id_pegawai' => 'id_pegawai']);
    }
}
