<style>
    .main-sidebar {
        background-color: rgba(54, 79, 107) !important;
    }
</style>

<?php
$url = Yii::getAlias("@web") . '/images/';
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Yii::$app->homeUrl ?>" class="brand-link">
        <img src="<?= $url ?>logobps.png" alt="Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">BPS BURU</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <?php
            use app\models\User;
            use app\models\Pegawai;

            if (!Yii::$app->user->isGuest) {
                $id_user = Yii::$app->user->getId();
                $user = User::findOne($id_user);
                $pegawai = Pegawai::findOne($user->id_pegawai);
                $id_pegawai = $pegawai->id_pegawai;
                $status = $pegawai->status;
                $cek_pegawai = ($status == 'Pegawai');

                if (Yii::$app->user->identity->role == "Admin") {
                    echo \hail812\adminlte\widgets\Menu::widget([
                        'items' => [
                            ['label' => 'Home', 'url' => ['site/index'], 'icon' => 'home'],
                            ['label' => 'Profil Saya', 'url' => ['pegawai/view', 'id_pegawai' => $id_pegawai], 'icon' => 'user'],
                            [
                                'label' => 'Penilaian Pegawai',
                                'icon' => 'tachometer-alt',
                                'items' => [
                                    ['label' => 'Progres Penilaian', 'url' => ['penilaian/progress'], 'iconStyle' => 'far'],
                                    ['label' => 'Penilaian Pegawai', 'url' => ['penilaian/daftar-penilaian'], 'iconStyle' => 'far', 'visible' => $cek_pegawai],
                                    ['label' => 'Rekap Penilaian', 'url' => ['penilaian/rekapitulasi'], 'iconStyle' => 'far'],
                                    ['label' => 'Daftar Pegawai Terbaik', 'url' => ['penilaian/pegawai-terbaik'], 'iconStyle' => 'far'],
                                ],
                            ],
                            [
                                'label' => 'Manajemen Pegawai',
                                'icon' => 'file',
                                'items' => [
                                    ['label' => 'Daftar Pegawai', 'url' => ['pegawai/index'], 'iconStyle' => 'far'],
                                    ['label' => 'Tambah Pegawai', 'url' => ['pegawai/create'], 'iconStyle' => 'far'],
                                ],
                            ],
                        ]
                    ]);
                } else {
                    echo \hail812\adminlte\widgets\Menu::widget([
                        'items' => [
                            ['label' => 'Home', 'url' => ['site/index'], 'icon' => 'home'],
                            ['label' => 'Profil Saya', 'url' => ['pegawai/view', 'id_pegawai' => $id_pegawai], 'icon' => 'user'],
                            ['label' => 'Penilaian Pegawai', 'url' => ['penilaian/daftar-penilaian', 'id'=>5], 'iconStyle' => 'far'],
                            ['label' => 'Evaluasi Pegawai', 'url' => ['penilaian/evaluasi-pegawai'], 'iconStyle' => 'far'],
                        ]
                    ]);
                }
            }
            ?>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
