<?php

namespace app\models;

use yii\base\Model;
use yii\data\ArrayDataProvider;


class RekapitulasiSearch extends Model
{
    public $bulan;
    public $tahun;

    public function rules()
    {
        return [
            [['bulan', 'tahun'], 'safe'],
        ];
    }

    public function getBulanList()
    {
        $bulanList = (new \yii\db\Query())
            ->select(['nama_bulan'])
            ->from('bulan')
            ->indexBy('nama_bulan')
            ->column();
        
        return $bulanList;
    }

    public function search($params, $data)
{
    // Validasi bahwa $data adalah array
    if (!is_array($data)) {
        $data = [];
    }

    $this->load($params);

    if (!$this->validate()) {
        // Jika validasi gagal, kembalikan data kosong
        return new ArrayDataProvider([
            'allModels' => [],
            'pagination' => false,
        ]);
    }

    // Ambil nama bulan dari tabel 'bulan'
    $filteredData = array_map(function ($item) {
        // Asumsikan $item['bulan'] adalah angka bulan
        $namaBulan = (new \yii\db\Query())
            ->select('nama_bulan')
            ->from('bulan')
            ->where(['id_bulan' => $item['bulan']])
            ->scalar();

        $item['bulan'] = $namaBulan ?: $item['bulan']; // Jika tidak ada nama bulan, gunakan angka
        return $item;
    }, $data);

    // Filter data berdasarkan bulan dan tahun
$filteredData = array_filter($filteredData, function ($item) {
    $match = true;

    if (!empty($this->bulan)) {
        $match = $match && (stripos($item['bulan'], $this->bulan) !== false);
    }

    if (!empty($this->tahun)) {
        $match = $match && ($item['tahun'] == $this->tahun);
    }

    return $match;
});


    // Buat instance ArrayDataProvider dengan data yang sudah difilter
    $query = new ArrayDataProvider([
        'allModels' => $filteredData,
        'pagination' => false,
        'sort' => [
            'attributes' => [
                'bulan',
                'tahun',
                'nama_pegawai',
                'total_skor',
            ],
            'defaultOrder' => [
                'tahun' => SORT_DESC,
                'bulan' => SORT_ASC,
            ],
        ],
    ]);

    return $query;

}

}