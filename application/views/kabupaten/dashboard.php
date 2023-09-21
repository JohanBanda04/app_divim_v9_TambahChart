<?php
session_start();
$ceks = $this->session->userdata('token_katamaran');
$link1 = $this->uri->segment(1);
$link2 = $this->uri->segment(2);
$link3 = $this->uri->segment(3);
$link4 = $this->uri->segment(4);
$link5 = $this->uri->segment(5);
$level = $this->session->userdata('level');

?>

<main class="main-content bgc-grey-100">
    <div id="mainContent">
        <div class="container-fluid">
            <?php

//            if ($_SESSION['token_katamaran']) {
//                echo "Terdapat data token : ".$_SESSION['token_katamaran'];
//            } else {
//                echo "Tidak Terdapat data token  ";
//            }
             ?>
            <div class="row fc-event-start justify-content-center" style="margin-left: 10px">
                <h2 class="font-weight-bold" style="margin: 0 0 40px 0; color: black; opacity: 70%">Dashboardsz</h2>


            </div>
            <br>
            <?php
            //echo "tess";
            if($this->session->flashdata('msg')){
                echo $this->session->flashdata('msg');
            }
            ?>
            <div class="row">

                <?php if($_SESSION['token_katamaran']) { ?>
                    <div  class="col-md-4" style="margin-bottom: 10px">


                        <div class="layers p-20 "
                             style="border-radius: 20px; border-color: #490411; border-style: solid ;  border-width: 5px">
                            <div class="layer w-100 mB-10">
                                <h6 class="lh-1" style="color: #373737">
                                    <!--ini data dari tabel 'zona' database api_divim-->
                                    Semua Data ITK
                                </h6>
                            </div>
                            <div class="layer w-100">
                                <div class="peers ai-sb fxw-nw">
                                    <!--dashboard1-->
                                    <?php
                                    $id_for_all = 0;
                                    ?>

                                    <?php if($_SESSION['token_katamaran']){ ?>
                                        <a href="izintinggal/data_itk/<?php echo hashids_encrypt($id_for_all);?>">
                                        <span class="pull-left" style="font-weight: bold">
                                            Lihat Data Izin Tinggal
                                            <?php
                                            // echo $data['id'];
                                            ?>
                                        </span>
                                        </a>
                                    <?php }  ?>
                                    <div class="peer peer-greed">
                                        <canvas width="45" height="20"
                                                style="display: inline-block; width: 45px; height: 20px; vertical-align: top;">

                                        </canvas>
                                    </div>
                                    <div class="peer">

                                        <?php if($_SESSION['token_katamaran']){ ?>
                                            <span style=" background-color: #490411; color: #fcfaff"
                                                  class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15  ">
                                            <?php

                                            $dataITK_byZona = $this->Guzzle_model->getAllDataITK();
                                            echo count($dataITK_byZona)." Data ITK";
                                            ?>
                                        </span>
                                        <?php }  ?>


                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                <?php } ?>


                <!--cara foreach data dari controller-->
                <?php foreach ($zona as $index => $data) {

                    ?>

                    <div <?php if($data['nama_zona']=="kasub_inteldakim"
                        || $data['nama_zona']=="superadmin" || $data['nama_zona']=="divim_kanwil"){
                        ?> hidden <?php
                    } ?> class="col-md-4" style="margin-bottom: 10px">


                        <div class="layers p-20 "
                             style="border-radius: 20px; border-color: <?= $data['warna_background']; ?>; border-style: solid ;  border-width: 5px">
                            <div class="layer w-100 mB-10">
                                <h6 class="lh-1" style="color: #373737">
                                    <!--ini data dari tabel 'zona' database api_divim-->
                                    <?php echo $data['nama_panjang'] ; ?>
                                </h6>
                            </div>
                            <div class="layer w-100">
                                <div class="peers ai-sb fxw-nw">
                                    <!--dashboard1-->

                                    <?php if($_SESSION['token_katamaran']){ ?>
                                        <a href="izintinggal/data_itk/<?= hashids_encrypt($data['id']);?>">
                                        <span class="pull-left" style="font-weight: bold">
                                            Lihat Data Izin Tinggals
                                            <?php
                                            // echo $data['id'];
                                            ?>
                                        </span>
                                        </a>
                                    <?php } else { ?>

                                        <button type="button" class="float-right btn_tambah" data-toggle="modal"
                                                data-target="#add_izin_tinggal<?php echo $data['id']; ?>">
                                            <span class="bg-float"></span>
                                            <span class="text">Tambah Data ITK
                                            </span>
                                        </button>
                                    <?php } ?>
                                    <div class="peer peer-greed">
                                        <canvas width="45" height="20"
                                                style="display: inline-block; width: 45px; height: 20px; vertical-align: top;">

                                        </canvas>
                                    </div>
                                    <div class="peer">


                                        <span style=" background-color: <?= $data['warna_background'] ?>; color: #fcfaff"
                                              class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15  ">
                                            <?php
                                            $dataITK_byZona = $this->Guzzle_model->getizintinggalByZona($data['id']);
                                            echo count($dataITK_byZona)." Data ITK";
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <?php
                } ?>


            </div>

            <!--bar chart dari sini-->
            <div class="row" >
                <div class="col-md-12" style="margin-bottom: 20px">
                    <div class="realisasi-card card" style="background-color: #57393e; border-radius: 45px">
                        <div class="card-body">
                            <!--grafik data paling awal bar chart zona daerah-->
                            <canvas id="bar_chart_zona_daerah" height="175">tes</canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!--bar chart sampai sini-->

            <div class="c-content-accordion-1 c-theme dashboard-all">
                <div class="panel-group" id="accordion" role="tablist">
                    <?php
                    //echo "<pre>"; print_r($array_daerah) ; die;
                    //echo "<pre>"; print_r($zona_daerah_list_ii) ; die;
                    ?>

                    <?php
                    $isFirst = true;
                    foreach ($array_daerah as $key=>$val){
                        //echo $val->id_zona."<br>";
                        ?>
                        <div class="panel">
                            <div class="panel-heading dipa-accordion-btn" role="tab"
                                 id="heading<?php echo $val->id_zona; ?>" style="color: white">
                                <h4 class="panel-title">
                                    <a class="c-font-bold c-font-19" data-toggle="collapse"
                                       data-parent="#accordion"
                                       href="#collapse<?php echo $val->id_zona; ?>"
                                       aria-expanded="true"
                                       aria-controls="collapse<?php echo $val->id_zona; ?>">
                                        <?php echo $val->nama_panjang; ?>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse<?php echo $val->id_zona; ?>"
                                 class="panel-collapse collapse <?php if ($isFirst) { echo "show"; } ?>"
                                 role="tabpanel"
                                 aria-labelledby="heading<?php echo $val->id_zona; ?>">
                                <div class="panel-body c-font-18">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="realisasi-card card" style="background: #0c121c">
                                                <div class="card-body">
                                                    <div class="penyerapan-chart row">
                                                        <div class="col-md-5">
                                                            <canvas id="chart_penyerapan<?php echo $val->id_zona; ?>"></canvas>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="dashboard-progress">
                                                                <div class="progress-title" style="color: white">
                                                                    TOTAL DATA ITK
                                                                </div>
                                                                <div class="text-white progress-angka" style="color: white">
                                                                    <?php

                                                                    $data_itkByZona = $this->Guzzle_model->getizintinggalByZona($val->id_zona);
                                                                    $data_itkByZona_and_Status_Selesai = $this->Guzzle_model->getizintinggalByZonaAndStatus($val->id_zona,"selesai");
                                                                    $data_itkByZona_and_Status_BelumSelesai = $this->Guzzle_model->getizintinggalByZonaAndNotStatus($val->id_zona,"selesai");
                                                                    //echo "<pre>"; print_r($data_itkByZona_and_Status_BelumSelesai);
                                                                    //echo count($data_itkByZona);
                                                                    $persentase_total = (count($data_itkByZona) * 100) / (count($data_itkByZona_and_Status_Selesai) + (count($data_itkByZona_and_Status_BelumSelesai))) ;

                                                                    $persentase_total_formatted = number_format($persentase_total,2,",","");
                                                                    if($persentase_total_formatted=='nan'){
                                                                        $persentase_total_formatted = 0;
                                                                    }
                                                                    echo count($data_itkByZona) ." DOKUMEN"." (".$persentase_total_formatted." %)";

                                                                    ?>
                                                                </div>
                                                                <div class="progress">
                                                                    <div class="progress-bar progress-bar-striped" role="progressbar"
                                                                         style="<?php if ($persentase_total_formatted=="nan"){ ?>
                                                                                 width: 0%;
                                                                         <?php } else  { ?>
                                                                                 width: 100%;
                                                                         <?php } ?>" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="dashboard-progress">
                                                                <div class="progress-title" style="color: white">
                                                                    DATA ITK (SELESAI)
                                                                </div>
                                                                <div class="text-white progress-angka" style="color: white">
                                                                    <?php

                                                                    $data_itkByZona = $this->Guzzle_model->getizintinggalByZona($val->id_zona);
                                                                    $data_itkByZona_and_Status_Selesai = $this->Guzzle_model->getizintinggalByZonaAndStatus($val->id_zona,"selesai");
                                                                    $data_itkByZona_and_Status_BelumSelesai = $this->Guzzle_model->getizintinggalByZonaAndNotStatus($val->id_zona,"selesai");
                                                                    //echo "<pre>"; print_r($data_itkByZona_and_Status_BelumSelesai);
                                                                    //echo count($data_itkByZona);
                                                                    $persentase_total_selesai = (count($data_itkByZona_and_Status_Selesai) * 100) / (count($data_itkByZona_and_Status_Selesai) + (count($data_itkByZona_and_Status_BelumSelesai))) ;

                                                                    $persentase_total_selesai_formatted = number_format($persentase_total_selesai,2,",","");
                                                                    if($persentase_total_selesai_formatted=='nan'){
                                                                        $persentase_total_selesai_formatted = 0;
                                                                    }
                                                                    echo count($data_itkByZona_and_Status_Selesai) ." DOKUMEN"." (".$persentase_total_selesai_formatted." %)";

                                                                    ?>
                                                                </div>
                                                                <div class="progress">
                                                                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
                                                                         aria-valuenow="<?php echo $persentase_total_selesai;  ?>"
                                                                         style="width: <?php echo $persentase_total_selesai; ?>%" aria-valuemin="0" aria-valuemax="100">

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="dashboard-progress">
                                                                <div class="progress-title" style="color: white">
                                                                    DATA ITK (BELUM SELESAI)
                                                                </div>
                                                                <div class="text-white progress-angka" style="color: white">
                                                                    <?php

                                                                    $data_itkByZona = $this->Guzzle_model->getizintinggalByZona($val->id_zona);
                                                                    $data_itkByZona_and_Status_Selesai = $this->Guzzle_model->getizintinggalByZonaAndStatus($val->id_zona,"selesai");
                                                                    $data_itkByZona_and_Status_BelumSelesai = $this->Guzzle_model->getizintinggalByZonaAndNotStatus($val->id_zona,"selesai");
                                                                    //echo "<pre>"; print_r($data_itkByZona_and_Status_BelumSelesai);
                                                                    //echo count($data_itkByZona);
                                                                    $persentase_total_belum_selesai = (count($data_itkByZona_and_Status_BelumSelesai) * 100) / (count($data_itkByZona_and_Status_Selesai) + (count($data_itkByZona_and_Status_BelumSelesai))) ;

                                                                    $persentase_total_belum_selesai_formatted = number_format($persentase_total_belum_selesai,2,",","");
                                                                    if($persentase_total_belum_selesai_formatted=='nan'){
                                                                        $persentase_total_belum_selesai_formatted = 0;
                                                                    }
                                                                    echo count($data_itkByZona_and_Status_BelumSelesai) ." DOKUMEN"." (".$persentase_total_belum_selesai_formatted." %)";

                                                                    ?>
                                                                </div>
                                                                <div class="progress">
                                                                    <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar"
                                                                         aria-valuenow="<?php echo $persentase_total_belum_selesai;  ?>"
                                                                         style="width: <?php echo $persentase_total_belum_selesai; ?>%" aria-valuemin="0" aria-valuemax="100">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $isFirst = false;
                    }
                    //die;
                    ?>
                </div>
            </div>

            <!-- Add, Detail, Edit, Delete Agenda  -->
            <?php
            // Add Agenda
            //$this->load->view('agenda/add_agenda');
            $this->load->view('kabupaten/izintinggal/add_izin_tinggal');

            //$this->load->view('kabupaten/izintinggal/simpan_izin_tinggal');
//


            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
    <script>

        var pemda_id = <?php echo json_encode($pemda_id);  ?>;
        //console.log("pemda id : " + pemda_id);

        const realisasi_pendataan_itk_total = <?php echo json_encode($realisasi_pendataan_itk_total); ?>;
        console.log(realisasi_pendataan_itk_total);

        const selesai_only = <?php echo json_encode($selesai_only); ?>;
        console.log(selesai_only);

        const belum_selesai_only = <?php echo json_encode($belum_selesai_only); ?>;
        console.log(belum_selesai_only);

        const total = <?php echo json_encode($total); ?>;
        //console.log("total : " + total);

        pemda_id.forEach(myFunction);

        function myFunction(value, key) {
            //console.log(value);
            var kode_pemda = key;

            /*belum dipake*/
            var options = {
                tooltips : {
                    enabled:true
                },
                plugins: {
                    datalabels: {
                        formatter: (value, ctx) => {
                            // console.log(ctx);
                            let sum = 0;
                            let dataArr = ctx.chart.data.datasets[0].data;
                            //console.log(ctx.chart.data);
                            dataArr.map(data => {
                                sum += data;
                            });

                            //sum = realisasi_satker_total[kode_satker] + sisa_satker_aktual[kode_satker];
                        }
                    },
                    legend: {
                        labels:{
                            font:{
                                size: 24,
                            },
                        }
                    },
                },

            };

            var ctx = document.getElementById('chart_penyerapan' + value).getContext('2d');

            var chart_penyerapan = new Chart(ctx,{
                type: 'pie',
                data: {
                    labels: ['Data ITK Selesai', 'Data ITK Belum Selesai'],
                    datasets: [{
                        /*cuky*/
                        data: [selesai_only[key],belum_selesai_only[key]],
                        backgroundColor: [
                            'rgba(0, 172, 172, 1)',
                            'rgba(234, 66, 114, 1)'
                        ],
                        borderColor: [
                            'rgba(45, 53, 60, 1)',
                            'rgba(45, 53, 60, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    tooltips : {
                        enabled:true
                    },
                    plugins: {
                        datalabels: {
                            formatter: (value, ctx) => {
                                console.log(ctx.chart.data);
                                let sum = 0;
                                let dataArr = ctx.chart.data.datasets[0].data;
                                //console.log(ctx.chart.data);
                                dataArr.map(data => {
                                    sum += data;
                                });

                                //sum = realisasi_satker_total[kode_satker] + sisa_satker_aktual[kode_satker];
                            }
                        },
                        legend: {
                            labels:{
                                font:{
                                    size: 24,
                                },
                            },

                        },
                        labels:{
                            render: 'label',
                            precision: 1,
                            arc: false,
                            position: 'border',
                            fontColor:[
                                'rgba(255,26,104,1)',
                                'rgba(54,162,235,1)',
                                'rgba(255,206,86,1)',
                            ],
                        },
                    },

                }
            });
        }
    </script>
    <script>
        var zona_daerah_list = <?php echo json_encode($zona_daerah_list_ii);  ?>;
        //console.log(zona_daerah_list);
        var nama_zona_daerah = [];
        var persen_realisasi = [];


        zona_daerah_list.forEach(fungsi);

        function fungsi(val, key){
            console.log(key);
            nama_zona_daerah[key] = val;
            let realisasi = realisasi_pendataan_itk_total[key];

            persen_realisasi[key] = (Math.round(((realisasi / total) * 100) * 100) / 100).toFixed(2)
        }

        const labels = nama_zona_daerah;
        const ctx = document.getElementById('bar_chart_zona_daerah');
        const myChart = new Chart(ctx,{
            type : 'bar',
            data : {
                labels : nama_zona_daerah,
                datasets : [{
                    label : 'Presentase DATA ITK WNA per Daerah (%)',
                    data: persen_realisasi,//[100,2,4,5,6,7,8,9,10,11,12,13,14,5.5,16,17,18,19,20,21,22,23,24,25], //[100.0,75.6,87.8,100.0,91.6,84.9,74.4,86.2,71.7,86.8,83.0,78.5,75.9,85.5,91.6,89.5,94.9,84.0,64.7,90.3,67.9,90.2,80.8,88.4,92.3]
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }],
            },
            options:{
                legend: {
                    labels: {
                        fontColor: 'white'
                    }
                },
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            fontColor: 'white'
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            autoSkip: false,
                            maxRotation: 90,
                            minRotation: 90,
                            padding: 20,
                            fontColor: 'white'
                        }
                    }]
                },
                plugins: {
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        formatter: (value, ctx) => {
                            return value + " %";
                        },
                        color: 'cyan',
                    }
                },
            }
        });
    </script>
</main>

  
