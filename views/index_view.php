
                <!-- Main content -->
                <section class="content">
                    <div class="container" style="max-width:100%;">
                        <div class="panel panel-primary">

                            <div class="panel-heading">
                                <h3 class="panel-title">Selamat bekerja!</h3>
                            </div>
                        
                            <div class="panel-body">
                                <form name="basicform" id="basicform" method="post" action="index/lihat_hasil">
                                    <!-- langkah pertama: input nisn -->
                                    <div id="sf1" class="frm">
                                        <fieldset>
                                            <legend>Langkah 1 dari 4: Input Data Siswa</legend>

                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="nisn">Masukkan NISN: </label>
                                                <div class="col-lg-6">
                                                    <input type="text" placeholder="NISN, contoh: 1234567890" id="nisn" name="nisn" class="form-control" autocomplete="off" value="123456789">
                                                </div>
                                            </div>
                                    
                                            <div class="clearfix" style="height: 10px;clear: both;"></div>

                                            <div class="form-group">
                                                <div class="col-lg-10 col-lg-offset-2">
                                                    <button class="btn btn-primary open1" type="button">Next <span class="fa fa-arrow-right"></span></button> 
                                                </div>
                                            </div>

                                        </fieldset>
                                    </div>
                                    <!-- end langkah pertama -->

                                    <!-- langkah ke-2: input nilai rapor -->
                                    <div id="sf2" class="frm" style="display: none;">
                                        <fieldset>
                                            <legend>Langkah 2 dari 4: Input Nilai Rapor Siswa</legend>
                                            
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <?php for($i = 1; $i <= $total_smstr; $i++): ?>
                                                        <th>Semester <?php echo $i; ?></th>
                                                        <?php endfor; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    foreach ($pelajaran as $key => $value): ?> 
                                                    <tr>
                                                        <td class="col-sm-1">
                                                            <?php echo $value; ?>
                                                        </td>
                                                        <?php for($i = 1; $i <= $total_smstr; $i++): ?>
                                                        <td class="col-sm-1">
                                                            <input class="col-sm-12" name="<?php echo $key.'_smstr'.$i; ?>" id="<?php echo $key.'_smstr'.$i; ?>" type="number" />
                                                        </td>
                                                        <?php endfor; ?>
                                                    </tr>
                                                <?php 
                                                    endforeach; ?>
                                                </tbody>
                                            </table>

                                            <div class="clearfix" style="height: 10px;clear: both;"></div>

                                            <div class="form-group">
                                                    <button class="btn btn-warning back2" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
                                                    <button class="btn btn-primary open2" type="button">Submit </button> 
                                            </div>

                                        </fieldset>
                                    </div>
                                    <!-- end langkah ke-2 -->

                                    <!-- langkah ke-3: Input nilai UN, Prestasi non-akademik,
                                    dan jurusan yang akan dipilih -->
                                    <div id="sf3" class="frm" style="display: none;">
                                        <fieldset>
                                            <legend>Langkah 3 dari 4: Input Nilai UN, Prestasi non-akademik dan Jurusan yang Dipilih.</legend>

                                            <div class="col-sm-4">
                                                <h3>Nilai Ujian Nasional</h3>
                                                <span class="helper-block">
                                                    *Masukan nilai ujian nasional SMP
                                                </span>
                                                <?php foreach ($mapel_un as $key => $value) { ?> 
                                                <div class="form-group">
                                                    <div class="col-sm-5">
                                                        <label class="control-label" for="$key">
                                                            <?php echo $value;?>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" id="<?php echo $key; ?>" name="<?php echo $key; ?>" class="form-control" autocomplete="off">
                                                    </div>
                                                    <br>
                                                </div>    
                                                <?php } ?>
                                            </div>

                                            <div class="col-sm-4">
                                                <h3>Jurusan yang Dipilih</h3>
                                                <span class="helper-block">
                                                    *Pilih jurusan yang dipilih saat ini
                                                </span>
                                                <?php foreach ($jurusan as $key => $value) { ?> 
                                                <div class="form-group">
                                                    <div class="col-sm-2 ">
                                                        <label class="control-label" for="$key">
                                                            <?php echo $value;?>
                                                        </label>
                                                    </div>
                                                    <div>
                                                        <input type="radio" id="jurusan_<?php echo $key; ?>" name="jurusan_<?php echo $key; ?>" value="1">Sangat ingin&nbsp;
                                                        <input type="radio" id="jurusan_<?php echo $key; ?>" name="jurusan_<?php echo $key; ?>" value="2">Ingin&nbsp; 
                                                        <input type="radio" id="jurusan_<?php echo $key; ?>" name="jurusan_<?php echo $key; ?>" value="3">Biasa&nbsp; 
                                                    </div>
                                                    <br>
                                                </div>
                                                    
                                                <?php } ?>
                                            </div>

                                            <div class="col-sm-4">
                                                <h3>Prestasi non-Akademik</h3>
                                                <span class="helper-block">
                                                    **Tidak usah diconteng jika tidak ada
                                                </span>
                                                <?php foreach ($ptsi_non as $key => $value) { ?> 
                                                <div class="form-group">
                                                    <label class="control-label" for="$key">
                                                        <input type="checkbox" id="<?php echo $key; ?>" value="1" name="<?php echo $key; ?>">
                                                        <?php echo $value;?>
                                                    </label>
                                                    <br>
                                                </div>
                                                    
                                                <?php } ?>
                                            </div>
                                            
                                            <div class="clearfix" style="height: 10px;clear: both;"></div>

                                            <div class="form-group">
                                                <button class="btn btn-warning back3" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
                                                <button class="btn btn-primary open3" type="button">Submit </button> 
                                            </div>

                                        </fieldset>
                                    </div>
                                    <!-- end langkah ke-3 -->

                                    <!-- langkah ke-4 -->
                                    <!-- simulasi soal bidang Sains -->
                                    <div id="sf4" class="frm" style="display: none;">
                                        <fieldset>
                                            <legend>Langkah 4 dari 4: Simulasi Soal.</legend>
                                            <div class="btn btn-group btn-lg">
                                                <a class="btn <?php if($soal['list_soal'][0]->id_jenis_soal == 1) echo "btn-info"; else echo "btn-default"; ?>" href="#">Ilmu Pengetahuan Alam</a>
                                                <a class="btn <?php if($soal['list_soal'][0]->id_jenis_soal == 2) echo "btn-info"; else echo "btn-default"; ?>" href="#">Ilmu Pengetahuan Sosial</a>
                                            </div>

                                            <div id="soal">
                                                <form method="post" action="#">
                                                    <?php
                                                    	$index_soal = 1; 
                                                    	foreach ($soal['list_soal'] as $key => $value): 
                                                	?>
                                                    <div class="col-sm-9">
                                                        <?php   
                                                            echo $value->id.". ";
                                                            echo $value->soal; 
                                                        for($i = 0; $i < 4; $i++):
                                                        ?>      
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="soal[<?php echo $index_soal; ?>]"value="<?php echo $soal['list_jawaban'][$value->id][$i]->id; ?>">
                                                                <?php 
                                                                    echo $soal['list_jawaban'][$value->id][$i]->pilihan_ganda.'. ';
                                                                    echo $soal['list_jawaban'][$value->id][$i]->jawaban; 
                                                                ?>
                                                            </label>
                                                        </div>
                                                        <?php 
                                                        	endfor; 
                                                        	$index_soal += 1;
                                                        ?>
                                                    </div>
                                                    <?php endforeach; ?>
                                                </form>
                                            </div>
                                            
                                            <div class="clearfix" style="height: 10px;clear: both;"></div>

                                            <div class="form-group">
                                                <button class="btn btn-warning back4" type="button"><span class="fa fa-arrow-left"></span> Back</button> 
                                                <button class="btn btn-primary open4" type="submit">Submit </button> 
                                            </div>
                                        </fieldset>
                                    </div>

                                    <!-- end langkah ke-4 -->
                                </form>
                            </div>
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        © <?php echo date("Y")?>

        <!-- jQuery 2.0.2 -->
        <script src="assets/js/jquery-1.12.0.min.js"></script>

        <!-- jQuery UI 1.10.3 -->
        <script src="assets/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>

        <!-- jQuery Validator -->
        <script src="assets/js/jquery.validate.min.js" type="text/javascript"></script>

        <!-- Custom jQuery -->
        <script src="assets/js/app.js" type="text/javascript"></script>

        <!-- Bootstrap -->
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="assets/js/AdminLTE/app.js" type="text/javascript"></script>
    </body>
</html>