<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pegawai;

class DaftarSearch extends Model
{
    public $nama_pegawai;

    public function rules()
    {
        return [
            [['nama_pegawai'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Pegawai::find()
            ->alias('pg') // ✅ pakai alias pegawai
            ->where(['pg.status' => 'Pegawai'])
            ->orderBy(['pg.nama_pegawai' => SORT_ASC]); // pakai array biar lebih aman

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // ✅ filter pakai alias
        $query->andFilterWhere(['like', 'pg.nama_pegawai', $this->nama_pegawai]);

        return $dataProvider;
    }
}
