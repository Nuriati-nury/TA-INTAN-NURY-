<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pegawai;

/**
 * PegawaiSearch represents the model behind the search form of `app\models\Pegawai`.
 */
class PegawaiSearch extends Pegawai
{
    public $nama_pegawai;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pegawai'], 'integer'],
            [['nama_pegawai','nip_baru', 'nip_lama', 'jabatan', 'email'], 'safe'],
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
        $query = Pegawai::find();
        $query->joinWith(['user']);
       

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            //$query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        // $query->andFilterWhere([
        //     'id_pegawai' => $this->id_pegawai,
        //     'nama_pegawai' =>$this->nama_pegawai,
        //     'nip_baru' =>$this->nip_baru,
        //     'nip_lama' =>$this->nip_lama,
        //     'jabatan' =>$this->jabatan,
        //     'status' => $this->status,
        //     'email' => $this->email,

        //     // 'user.username'=> $this->username,
        // ]);

         $query->andFilterWhere(['like', 'nama_pegawai', $this->nama_pegawai]);
         $query->andFilterWhere(['like', 'nip_baru', $this->nip_baru]);
         $query->andFilterWhere(['like', 'nip_lama', $this->nip_lama]);
         $query->andFilterWhere(['like', 'jabatan', $this->jabatan]);
         // $query->andFilterWhere(['like', 'status', $this->status]);
         $query->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }

    public function getPenilaians()
    {
        return $this->hasMany(Penilaian::class, ['id_pegawai_dinilai' => 'id_pegawai']);
    }

    public function actionExportExcel()
{
    $searchModel = new RekapitulasiSearch();
    $data = $this->getPegawaiTerbaikData(); // fungsi ambil query pegawai terbaik
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $data);

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Tahun');
    $sheet->setCellValue('B1', 'Bulan');
    $sheet->setCellValue('C1', 'Nama Pegawai');
    $sheet->setCellValue('D1', 'Total Skor');

    $row = 2;
    foreach ($dataProvider->models as $item) {
        $sheet->setCellValue("A{$row}", $item['tahun']);
        $sheet->setCellValue("B{$row}", $item['bulan']);
        $sheet->setCellValue("C{$row}", $item['nama_pegawai']);
        $sheet->setCellValue("D{$row}", $item['total_skor']);
        $row++;
    }

    $writer = new Xlsx($spreadsheet);
    $filename = 'pegawai_terbaik.xlsx';

    Yii::$app->response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    Yii::$app->response->headers->set('Content-Disposition', "attachment;filename=\"{$filename}\"");
    Yii::$app->response->headers->set('Cache-Control', 'max-age=0');

    $writer->save('php://output');
    Yii::$app->end();
}

public function actionExportPdf()
{
    $searchModel = new RekapitulasiSearch();
    $data = $this->getPegawaiTerbaikData();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $data);

    $content = $this->renderPartial('_pdfPegawaiTerbaik', [
        'dataProvider' => $dataProvider,
    ]);

    $pdf = new Pdf([
        'mode' => Pdf::MODE_UTF8,
        'content' => $content,
        'options' => ['title' => 'Pegawai Terbaik'],
    ]);

    return $pdf->render();
}
}
