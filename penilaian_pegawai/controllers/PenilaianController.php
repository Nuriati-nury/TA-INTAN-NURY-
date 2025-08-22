<?php

namespace app\controllers;

use Yii;
use app\models\Bulan;
use app\models\User;
use app\models\Pegawai;
use app\models\PegawaiSearch;
use app\models\Penilaian;
use app\models\PenilaianSearch;
use app\models\Cek;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use app\models\RekapitulasiSearch;
use app\models\DaftarSearch;
use yii\data\ArrayDataProvider;

/**
 * PenilaianController implements the CRUD actions for Penilaian model.
 */
class PenilaianController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Penilaian models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DaftarSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /** menampilkan daftar pegawai yg akan dinilai
     */
   public function actionDaftarPenilaian()
{
    if (Yii::$app->user->isGuest) {
        return $this->redirect(['site/login']);
    } else {
        $searchModel = new DaftarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // ✅ konsisten pakai alias
        $dataProvider->query
            ->alias('pg')           // alias tabel pegawai
            ->joinWith(['user u'])  // alias tabel user
            ->andWhere(['u.status' => 10])       // hanya user aktif
            ->andWhere(['pg.status' => 'Pegawai']); // hanya pegawai

        $id_bulan = Yii::$app->formatter->asDatetime('now', 'php:m');
        $bulan = Bulan::findOne($id_bulan);

        $id_user = Yii::$app->user->getId();
        $user = User::findOne($id_user);
        $pegawai_penilai = Pegawai::findOne($user->id_pegawai);

        return $this->render('daftar_penilaian', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'bulan' => $bulan,
            'pegawai_penilai' => $pegawai_penilai,
        ]);
    }
}


    /**
     * Displays a single Penilaian model.
     * @param int $id_penilaian Id Penilaian
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_penilaian)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_penilaian),
        ]);
    }

    /**
     * Creates a new Penilaian model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        } else {
            $nama_pegawai = Penilaian::getAllPegawai();
            $id_pegawai_penilai = Yii::$app->user->getId();

            $model = new Penilaian();
            // echo '<pre>';
            // print_r($id_pegawai_penilai);
            // die();
            if ($this->request->isPost) {
                if ($model->load($this->request->post())) {
                    $model->tanggal_submit = Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
                    $model->id_pegawai_penilai = $id_pegawai_penilai;
                    $model->calculateTotalScore();
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Data  berhasil disimpan'); 
                        return $this->redirect(['create']);
                    }
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render('create', [
                'model' => $model,
                'nama_pegawai' => $nama_pegawai,
            ]);
        }
    }

    public function actionNilai($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        } else {    
            $nama_pegawai = Penilaian::getAllPegawai();

            $id_user = Yii::$app->user->getId();
            $pegawai_penilai = User::findOne($id_user);
            $id_pegawai_penilai = $pegawai_penilai->id_pegawai;

            $pegawai_dinilai = Pegawai::findOne($id);

            $id_bulan = Yii::$app->formatter->asDatetime('now', 'php:m');
            $bulan = Bulan::findOne($id_bulan);
            $tahun = Yii::$app->formatter->asDatetime('now', 'php:Y');

            $kode_penilaian = intval(sprintf((strval($tahun) . strval($id_bulan) . strval($id_pegawai_penilai) . strval($id))));
            // echo '<pre>';
            //     print_r($kode_penilaian);
            //     die();

            if ($id < 23) {
                $id_pegawai_dinilai = $id;
                $model = new Penilaian();
                $modelCek = new Cek();
                // echo '<pre>';
                // print_r($id_pegawai_dinilai);
                // die();
                if ($this->request->isPost) {
                    if ($model->load($this->request->post())) {
                        $model->tanggal_submit = Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
                        $model->id_pegawai_penilai = $id_pegawai_penilai;
                        $model->periode = $id_bulan;
                        $model->id_pegawai_dinilai = $id_pegawai_dinilai;
                        $model->calculateTotalScore();
                        $model->kode_penilaian = $kode_penilaian;

                        $modelCek->kode_cek_penilaian = $kode_penilaian;
                        // echo '<pre>';
                        //         print_r($id);print_r($id_pegawai_dinilai);
                        //         die();
                        if ($modelCek->save()) {
                            if ($model->save()) {
                                Yii::$app->session->setFlash('success', 'Data  berhasil disimpan'); 
                                $id = $id_pegawai_dinilai + 1;
                                    // echo '<pre>';
                                    // print_r($id);print_r($id_pegawai_dinilai);
                                    // die();
                                return $this->redirect(['nilai', 
                                    'id' => $id]);
                                // echo '<pre>';
                                //     print_r($id);print_r($id_pegawai_dinilai);
                                //     die();
                            }
                        }
                    }
                } else {
                    $model->loadDefaultValues();
                }
            } else {
                return $this->redirect(['daftar-penilaian']);
            }    

            return $this->render('nilai_pegawai', [
                'model' => $model,
                'nama_pegawai' => $nama_pegawai,            
                'pegawai_dinilai' => $pegawai_dinilai,
                'bulan' => $bulan,
            ]);
        }
    }

    //create penilaian berdasarkan nama pegawai
    public function actionNilaiPegawai($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        } else {
            $nama_pegawai = Penilaian::getAllPegawai();

            $id_user = Yii::$app->user->getId();
            $pegawai_penilai = User::findOne($id_user);
            $id_pegawai_penilai = $pegawai_penilai->id_pegawai;

            $pegawai_dinilai = Pegawai::findOne($id);

            $id_bulan = Yii::$app->formatter->asDatetime('now', 'php:m');
            $bulan = Bulan::findOne($id_bulan);
            $tahun = Yii::$app->formatter->asDatetime('now', 'php:Y');

            $kode_penilaian = intval(sprintf((strval($tahun) . strval($id_bulan) . strval($id_pegawai_penilai) . strval($id))));
             
            $cek = Cek::findOne($kode_penilaian);
            
            $model = new Penilaian();
            $modelCek = new Cek();
            // echo '<pre>';
            // print_r($model);
            // die();
            if ($cek == null) {
                if ($this->request->isPost) {
                    if ($model->load($this->request->post())) {      
                        $model->tanggal_submit = Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
                        $model->id_pegawai_penilai = $id_pegawai_penilai;
                        $model->periode = $id_bulan;
                        $model->kode_penilaian = $kode_penilaian;
                        $model->id_pegawai_dinilai = $id;
                        $model->calculateTotalScore();
                        $model->kode_penilaian = $kode_penilaian;
                                        
                        $modelCek->kode_cek_penilaian = $kode_penilaian;
                        // echo '<pre>';
                        // echo gettype($kode_penilaian);
                        // die();

                        if ($modelCek->save()) {
                            if ($model->save()) {
                                Yii::$app->session->setFlash('success', 'Data  berhasil disimpan'); 
                                return $this->redirect(['daftar-penilaian']);
                            } 
                        }                                  
                    }
                } else {
                    $model->loadDefaultValues();
                }
            } else {
                Yii::$app->session->setFlash('error', 'Anda sudah memberikan penilaian pada pegawai tersebut untuk periode ini'); 
                return $this->redirect(['daftar-penilaian']);
            }

            return $this->render('nilai_pegawai', [
                'model' => $model,
                'nama_pegawai' => $nama_pegawai,
                'pegawai_dinilai' => $pegawai_dinilai,
                'bulan' => $bulan,
            ]);
        }
    }

    /**
     * Updates an existing Penilaian model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_penilaian Id Penilaian
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_penilaian)
    {
        $model = $this->findModel($id_penilaian);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_penilaian' => $model->id_penilaian]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Penilaian model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_penilaian Id Penilaian
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_penilaian)
    {
        $this->findModel($id_penilaian)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Penilaian model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_penilaian Id Penilaian
     * @return Penilaian the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_penilaian)
    {
        if (($model = Penilaian::findOne(['id_penilaian' => $id_penilaian])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');

    }

    public function actionRekapitulasi()
    {
        $searchModel = new RekapitulasiSearch();
        $data = [];

        // Mengambil data dari model
        $totalSkorQuery = (new \yii\db\Query())
            ->select([
                'bulan' => 'penilaian.periode',
                'tahun' => 'penilaian.tahun',
                'id_pegawai' => 'penilaian.id_pegawai_dinilai',
                'nama_pegawai' => 'pegawai.nama_pegawai',
                'total_skor' => 'SUM(penilaian.skor)',
            ])
            ->from('penilaian')
            ->innerJoin('pegawai', 'penilaian.id_pegawai_dinilai = pegawai.id_pegawai')
            ->groupBy(['penilaian.tahun', 'penilaian.periode', 'penilaian.id_pegawai_dinilai'])
            ->orderBy(['penilaian.tahun' => SORT_DESC, 'penilaian.periode' => SORT_ASC, 'total_skor' => SORT_DESC])
            ->all();

        // Menerapkan pencarian
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $totalSkorQuery);
         // simpan ke session agar bisa dipakai di export
        Yii::$app->session->set('rekapData', $dataProvider->getModels());

        return $this->render('rekapitulasi', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPegawaiTerbaik()
    {
        $searchModel = new RekapitulasiSearch();
        $data = [];

        // Mengambil data dari model
        $totalSkorQuery = Yii::$app->db->createCommand("
            SELECT bulan, tahun, id_pegawai, nama_pegawai, 
                max(b.total) as total_skor
            FROM (
                SELECT a.periode as bulan, 
                    a.tahun as tahun, 
                    a.id_pegawai_dinilai as id_pegawai, 
                    p.nama_pegawai as nama_pegawai,
                    SUM(a.skor) as total 
                FROM penilaian a INNER JOIN pegawai p
                ON a.id_pegawai_dinilai = p.id_pegawai
                GROUP BY a.tahun, a.periode, a.id_pegawai_dinilai              
                ORDER BY a.tahun DESC, a.periode DESC, total DESC
            ) b
            GROUP BY tahun, bulan
        ")->queryAll(); 

        // Menerapkan pencarian
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $totalSkorQuery);
        Yii::$app->session->set('terbaikData', $dataProvider->getModels());

        return $this->render('pegawai_terbaik', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



// ===================== REKAPITULASI =======================
public function actionExportExcelRekapitulasi($bulan = null, $tahun = null)
{
    $searchModel = new \app\models\RekapitulasiSearch();
    $dataProvider = $searchModel->search([
        'RekapitulasiSearch' => [
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]
    ], \Yii::$app->session->get('rekapData', []));

    $models = $dataProvider->getModels();

    header("Content-Type: text/csv; charset=utf-8");
    header("Content-Disposition: attachment;filename=rekapitulasi.csv");

    $output = fopen("php://output", "w");
    fputcsv($output, ['Tahun', 'Bulan', 'Nama Pegawai', 'Total Skor']);

    foreach ($models as $row) {
        fputcsv($output, [$row['tahun'], $row['bulan'], $row['nama_pegawai'], $row['total_skor']]);
    }

    fclose($output);
    exit;
}




// ===================== PEGAWAI TERBAIK =======================
public function actionExportExcelPegawaiTerbaik()
{
    $data = Yii::$app->session->get('terbaikData', []);

    header("Content-Type: text/csv; charset=utf-8");
    header("Content-Disposition: attachment;filename=pegawai_terbaik.csv");

    $output = fopen("php://output", "w");
    fputcsv($output, ['Tahun', 'Bulan', 'Nama Pegawai', 'Total Skor']);

    foreach ($data as $row) {
        fputcsv($output, [$row['tahun'], $row['bulan'], $row['nama_pegawai'], $row['total_skor']]);
    }

    fclose($output);
    exit;
}

public function actionProgress()
{
    $bulan = Yii::$app->request->get('bulan', date('n'));
    $tahun = Yii::$app->request->get('tahun', date('Y'));

    // Ambil semua user aktif yang punya relasi ke pegawai
    $users = User::find()
        ->alias('u')
        ->joinWith('pegawai pg')
        ->where(['u.status' => 10]) // hanya user aktif
        ->all();

    $progressList = [];

    // Hitung total pegawai yang harus dinilai (semua pegawai, tanpa filter status user)
    $totalPegawai = Pegawai::find()
        ->where(['status' => 'Pegawai'])
        ->count();

    foreach ($users as $user) {
        $pegawai = $user->pegawai;

        if (!$pegawai) {
            continue; // skip jika user tidak punya pegawai
        }

        // Hitung berapa pegawai yang sudah dinilai oleh user ini
        $sudahDinilai = Penilaian::find()
            ->where([
                'id_pegawai_penilai' => $pegawai->id_pegawai,
                'periode' => $bulan,
                'tahun' => $tahun,
            ])
            ->count();

        // Hitung progress
        $progress = $totalPegawai > 0 ? round(($sudahDinilai / $totalPegawai) * 100, 2) : 0;
        if ($progress > 100) $progress = 100; // memastikan max 100%

        // Tentukan status
        if ($progress >= 100) {
            $status = "<span class='badge bg-success'>Selesai</span>";
        } elseif ($progress > 0) {
            $status = "<span class='badge bg-warning text-dark'>Sedang Berjalan</span>";
        } else {
            $status = "<span class='badge bg-danger'>Belum Mulai</span>";
        }

        $progressList[] = [
            'username' => $user->username,
            'nama_pegawai' => $pegawai->nama_pegawai,
            'progress' => $progress . '%',
            'status' => $status,
        ];
    }

    // Hitung rata-rata progress global
    $avgProgress = count($progressList) > 0
        ? round(array_sum(array_map(function($p) { return (float) rtrim($p['progress'], '%'); }, $progressList)) / count($progressList), 2)
        : 0;

    return $this->render('progress', [
        'progressList' => $progressList,
        'bulan' => $bulan,
        'tahun' => $tahun,
        'avgProgress' => $avgProgress,
    ]);
}


public function actionEvaluasiPegawai($bulan = null, $tahun = null)
{
    if (Yii::$app->user->isGuest) {
        return $this->redirect(['site/login']);
    }

    // default bulan & tahun sekarang
    $bulan = $bulan ?? date('n');
    $tahun = $tahun ?? date('Y');

    // ambil id pegawai dari user login
    $idUser = Yii::$app->user->id;
    $user = \app\models\User::findOne($idUser);

    if (!$user || !$user->id_pegawai) {
        throw new \yii\web\NotFoundHttpException("Pegawai tidak ditemukan untuk user ini.");
    }

    $idPegawai = $user->id_pegawai;

    // panggil function di model
    $evaluasi = \app\models\Penilaian::getEvaluasiByPegawai($idPegawai, $bulan, $tahun);

    return $this->render('evaluasi_pegawai', [
        'evaluasi' => $evaluasi,
        'bulan' => $bulan,
        'tahun' => $tahun,
    ]);
}


}



