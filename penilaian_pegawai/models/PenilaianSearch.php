<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Penilaian;

/**
 * PenilaianSearch represents the model behind the search form of `app\models\Penilaian`.
 */
class PenilaianSearch extends Penilaian
{
    public $nama_pegawai;
    public $nama_bulan;
  

   
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_penilaian', 'id_pegawai_dinilai','tahun', 'id_pegawai_penilai', 'q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9', 'q10', 'q11', 'skor'], 'integer'],
            [['periode', 'tanggal_submit','nama_pegawai','nama_bulan'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Penilaian::find();
        $query->joinWith('pegawaiDinilai');
        $query->joinWith('bulan');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

         $dataProvider->sort->attributes['nama_pegawai'] = [
            'asc' => ['pegawai.nama_pegawai' => SORT_ASC],
            'desc' => ['pegawai.nama_pegawai' => SORT_DESC],
             ];

         $dataProvider->sort->attributes['nama_bulan'] = [
            'asc' => ['bulan.nama_bulan' => SORT_ASC],
            'desc' => ['bulan.nama_bulan' => SORT_DESC],
             ];



        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_penilaian' => $this->id_penilaian,
            'id_pegawai_dinilai' => $this->id_pegawai_dinilai,
            'tahun' => $this->tahun,
            'id_pegawai_penilai' => $this->id_pegawai_penilai,
            'q1' => $this->q1,
            'q2' => $this->q2,
            'q3' => $this->q3,
            'q4' => $this->q4,
            'q5' => $this->q5,
            'q6' => $this->q6,
            'q7' => $this->q7,
            'q8' => $this->q8,
            'q9' => $this->q9,
            'q10' => $this->q10,
            'q11' => $this->q11,
            'tanggal_submit' => $this->tanggal_submit,
            'skor' => $this->skor,
        ]);

        $query->andFilterWhere(['like', 'periode', $this->periode]);
         $query->andFilterWhere(['like', 'pegawai.nama_pegawai', $this->nama_pegawai]); 
         $query->andFilterWhere(['like', 'bulan.nama_bulan', $this->nama_bulan]); 

        return $dataProvider;
    }


   public function getProgress($idPegawaiPenilai, $bulan, $tahun)
    {
        // Total target: pegawai aktif selain dirinya
        $totalTarget = Pegawai::find()
            ->where(['status' => 10])
            ->andWhere(['<>', 'id_pegawai', $idPegawaiPenilai])
            ->count();

        // Sudah dinilai (distinct orang) oleh penilai ini pada periode tsb, hanya yang DINILAI aktif
        $doneCount = (new Query())
            ->from('penilaian pn')
            ->innerJoin('pegawai pd', 'pd.id_pegawai = pn.id_pegawai_dinilai AND pd.status = 10')
            ->where([
                'pn.id_pegawai_penilai' => $idPegawaiPenilai,
                'pn.periode'            => $bulan,
                'pn.tahun'              => $tahun,
            ])
            ->groupBy('pn.id_pegawai_dinilai')
            ->count();

        if (!$totalTarget) {
            return [
                'text'   => 'Tidak ada target',
                'status' => '<span class="badge badge-secondary">N/A</span>',
            ];
        }

        $percent = round(($doneCount / $totalTarget) * 100);
        $statusBadge = $doneCount >= $totalTarget
            ? '<span class="badge badge-success">Selesai</span>'
            : '<span class="badge badge-warning">Belum Selesai</span>';

        return [
            'text'   => "{$doneCount} / {$totalTarget} pegawai ({$percent}%)",
            'status' => $statusBadge,
        ];
    }





}
