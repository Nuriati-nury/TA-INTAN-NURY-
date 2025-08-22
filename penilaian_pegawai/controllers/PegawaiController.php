<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Pegawai;
use app\models\PegawaiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\data\ActiveDataProvider;

/**
 * PegawaiController implements the CRUD actions for Pegawai model.
 */
class PegawaiController extends Controller
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
     * Lists all Pegawai models.
     *
     * @return string
     * 
     */
    public function actionIndex()
    {
        $searchModel = new PegawaiSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
     

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            // 'user' => $user,
        ]);
    }

    /**
     * Displays a single Pegawai model.
     * @param int $id_pegawai Id Pegawai
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_pegawai)
    {
        // $id_user = Yii::$app->user->getId();
        // $pegawai = User::findOne($id_user);
        // $id_pegawai = $pegawai->id_pegawai;
        return $this->render('view', [
            'model' => $this->findModel($id_pegawai),
            'id_pegawai' => $id_pegawai,
        ]);
    }

    public function actionViewSelf($id_pegawai)
    {
        $id_user = Yii::$app->user->getId();
        $pegawai = User::findOne($id_user);
        $id_pegawai = $pegawai->id_pegawai;
        return $this->render('view', [
            'model' => $this->findModel($id_pegawai),
            'id_pegawai' => $id_pegawai,
        ]);
    }


    /**
     * Creates a new Pegawai model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    // public function actionCreate()
    // {
    //     $model = new Pegawai();

    //     if ($this->request->isPost) {
    //         if ($model->load($this->request->post()) && $model->save()) {
    //             return $this->redirect(['view', 'id_pegawai' => $model->id_pegawai]);
    //         }
    //     } else {
    //         $model->loadDefaultValues();
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }

    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        } else {    
            $model = new Pegawai();
            $modelUser = new User();
            // echo '<pre>';
            // print_r($id_pegawai_dinilai);
            // die();
            if ($this->request->isPost) {
                if ($model->load($this->request->post()) && $model->validate() && $modelUser->load($this->request->post()) && $modelUser->validate()) {
                   
                            // echo '<pre>';
                            // print_r($modelUser);
                            // print_r($_POST);
                            // die();
                    
                    $modelUser->time_create = Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
                    $modelUser->time_update = Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');
                    $modelUser->authKey = \Yii::$app->security->generateRandomString();
                    $modelUser->accessToken = $modelUser->authKey;
                    // $modelUser->status = '10';
                    // $modelUser->role = 'user';
                    if ($model->save()) {
                        $modelUser->id_pegawai = $model->id_pegawai;
                        if ($modelUser->save()) {
                            Yii::$app->session->setFlash('success', 'Data  berhasil disimpan'); 
                            return $this->redirect(['view', 'id_pegawai' => $model->id_pegawai]);
                            // echo '<pre>';
                            //     print_r($id);print_r($id_pegawai_dinilai);
                            //     die();
                        }
                    }
                }
            } else {
                $model->loadDefaultValues();
            }

            return $this->render('create', [
                'model' => $model,
                'modelUser' => $modelUser,
            ]);
        }
    }

    /**
     * Updates an existing Pegawai model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_pegawai Id Pegawai
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionUpdate($id_pegawai)
    // {
    //     $model = $this->findModel($id_pegawai);

    //     if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id_pegawai' => $model->id_pegawai]);
    //     }

    //     return $this->render('update', [
    //         'model' => $model,
    //     ]);
    // }

public function actionUpdate($id_pegawai)
{
    $model = $this->findModel($id_pegawai);
    $modelUser = $this->findModelUser($id_pegawai);

    if (
        Yii::$app->request->isPost &&
        $model->load(Yii::$app->request->post()) &&
        $modelUser->load(Yii::$app->request->post())
    ) {
        if (!Yii::$app->user->isGuest) {
            // Kalau bukan admin, kunci status & role supaya tidak bisa diubah
            if (Yii::$app->user->identity->role !== 'Admin') {
                $modelUser->status = $modelUser->getOldAttribute('status');
                $modelUser->role = $modelUser->getOldAttribute('role');
            }
        } else {
            return $this->redirect(['site/login']);
        }

        // Set waktu update
        $modelUser->time_update = Yii::$app->formatter->asDatetime('now', 'php:Y-m-d H:i:s');

        if ($model->validate() && $modelUser->validate()) {
            if ($model->save(false) && $modelUser->save(false)) {
                Yii::$app->session->setFlash('success', 'Data berhasil di-update');

                // Redirect sesuai role
                if (Yii::$app->user->identity->role === 'Admin') {
                    return $this->redirect(['index']); // ke daftar pegawai
                } else {
                    return $this->redirect(['view', 'id_pegawai' => $model->id_pegawai]); // ke halaman view
                }
            }
        }
    }

    return $this->render('update', [
        'model' => $model,
        'modelUser' => $modelUser,
    ]);
}






    /**
     * Deletes an existing Pegawai model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_pegawai Id Pegawai
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_pegawai)
    {

        $user = User::findOne(['id_pegawai'=>$id_pegawai]);

        if ($this->findModelUser($user->id)->delete() && $this->findModel($id_pegawai)->delete()) {
            Yii::$app->session->setFlash('success', 'Data  berhasil dihapus'); 
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Pegawai model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_pegawai Id Pegawai
     * @return Pegawai the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_pegawai)
    {
        if (($model = Pegawai::findOne(['id_pegawai' => $id_pegawai])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelUser($id_pegawai)
    {
        if (($model = User::findOne(['id_pegawai' => $id_pegawai])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
