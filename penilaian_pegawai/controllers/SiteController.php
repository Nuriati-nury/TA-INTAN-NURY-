<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Pegawai;
use app\models\User;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
{
    if (Yii::$app->user->isGuest) {
        return $this->redirect(['login']);
    } else {
        $userId = Yii::$app->user->id;
        $user = User::findOne($userId);
        $id_pegawai = $user->id_pegawai;
        $pegawai = Pegawai::findOne($id_pegawai);

        // Data grafik pegawai terbaik per bulan
        $grafikData = Yii::$app->db->createCommand("
            SELECT tahun, bulan, nama_pegawai, total_skor
            FROM (
                SELECT a.tahun, a.periode as bulan, p.nama_pegawai, SUM(a.skor) as total_skor,
                       RANK() OVER (PARTITION BY a.tahun, a.periode ORDER BY SUM(a.skor) DESC) as ranking
                FROM penilaian a 
                INNER JOIN pegawai p ON a.id_pegawai_dinilai = p.id_pegawai
                GROUP BY a.tahun, a.periode, a.id_pegawai_dinilai
            ) ranked
            WHERE ranking = 1
            ORDER BY tahun DESC, bulan ASC
        ")->queryAll();

        return $this->render('index', [
            'pegawai' => $pegawai,
            'grafikData' => $grafikData
        ]);
    }
}



    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        // $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['login']);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    
    // public function beforeAction($action)
    // {

    //     if (!parent::beforeAction($action)) {
    //         return false;
    //     }

    //     // Check only when the user is logged in
    //     if ( !Yii::$app->user->isGuest)  {
    //         if (Yii::$app->session['userSessionTimeout'] < time()) {
    //             Yii::$app->user->logout();
                
    //         } else {
    //             Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
    //             return true; 
    //         }
    //     } else {
    //         return true;
    //     }
    // }

    
}
