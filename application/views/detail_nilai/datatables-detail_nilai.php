<script type="text/javascript">
            var save_method;
            var table;
            $(document).ready(function(){
                table=$('#table').DataTable({
                    "processing":false,
                    "serverSide":true,
                    "searching":false,
                    "aaSorting":[[0,'asc']],
                    "lengthMenu":[ [10, 15, 20, -1], [ 10, 15, 20, "All"]],
                    "ajax":{
                        "url":"<?php echo site_url('Detail_nilai/ajax_list/'.$id);?>",
                        "type":"POST"
                    },
        
                    "columnDefs":[
                    {
                        "targets":[ -1,1,2 ],
                        "orderable":false,
                    },
                    ],
                });

                //agar ketika tekan tombol enter, form terkirim normal
                $("#form").submit(function( event ) {
                    save();
                  event.preventDefault();
                });

                $("#form2").submit(function( event ) {
                    save();
                  event.preventDefault();
                });

                
                //agar ketika close validasi di hilangkan
                $('#modal_form').on('hidden.bs.modal', function() {
                    $("#form")[0].reset();
                    $("#form2")[0].reset();
                    $("#form").formValidation("destroy");
                    $("#form2").formValidation("destroy");
                    //reload_table();
                    
                });

                $('#modal_bobot').on('hidden.bs.modal', function() {
                    $("#form")[0].reset();
                    $("#form2")[0].reset();
                    $("#form").formValidation("destroy");
                    $("#form2").formValidation("destroy");
                    //reload_table();
                    
                });
            });
            
            function reload_table()
            {
              table.ajax.reload(null,false); //reload datatable ajax 
            }
            
            function validasi(){
                var id=document.getElementById("id_penilaian").value;
                $("#form").formValidation({
                    message: 'This value is not valid',
                    excluded: ':disabled',
                    icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                    },
                    fields:{

                        id_karyawan:{
                            message:"ID Karyawan Tidak Valid",
                            validators:{
                                notEmpty:{
                                    message:'ID karyawan harus di isi'
                                },
                                remote:{
                                    type:'POST',
                                    url:'<?php echo base_url();?>Detail_nilai/cek/'+id,
                                    message:'ID Karyawan sudah digunakan'
                                }
                            }
                        },
                        c1:{
                            message:"Inputan Tidak Valid",
                            validators:{
                                notEmpty:{
                                    message:"Kehadiran harus di isi"
                                },
                                between:{
                                    min:1,
                                    max:10
                                },
                                integer:{
                                    message:'Harus angka bilangan bulat'
                                }
                            }
                        },
                        c2:{
                            message:"Inputan Tidak Valid",
                            validators:{
                                notEmpty:{
                                    message:"Motivasi Kerja harus di isi"
                                },
                                between:{
                                    min:1,
                                    max:10
                                },
                                integer:{
                                    message:'Harus angka bilangan bulat'
                                }
                            }
                        },
                        c3:{
                            message:"Inputan Tidak Valid",
                            validators:{
                                notEmpty:{
                                    message:"Komunikasi & Kerjasama harus di isi"
                                },
                                between:{
                                    min:1,
                                    max:10
                                },
                                integer:{
                                    message:'Harus angka bilangan bulat'
                                }
                            }
                        },
                        c4:{
                            message:"Inputan Tidak Valid",
                            validators:{
                                notEmpty:{
                                    message:"Pemahaman Pekerjaan harus di isi"
                                },
                                between:{
                                    min:1,
                                    max:10
                                },
                                integer:{
                                    message:'Harus angka bilangan bulat'
                                }
                            }
                        },
                        c5:{
                            message:"Inputan Tidak Valid",
                            validators:{
                                notEmpty:{
                                    message:"Pengembangan Diri harus di isi"
                                },
                                between:{
                                    min:1,
                                    max:10
                                },
                                integer:{
                                    message:'Harus angka bilangan bulat'
                                }
                            }
                        },
                        c6:{
                            message:"Inputan Tidak Valid",
                            validators:{
                                notEmpty:{
                                    message:"Pencapaian Target Kerja harus di isi"
                                },
                                between:{
                                    min:1,
                                    max:10
                                },
                                integer:{
                                    message:'Harus angka bilangan bulat'
                                }
                            }
                        }
                                               
                    }

                });
                 
                
            }

            function validasi2(){
                $("#form").formValidation({
                    message: 'This value is not valid',
                    excluded: ':disabled',
                    icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                    },
                    fields:{

                        c1:{
                            message:"Inputan Tidak Valid",
                            validators:{
                                notEmpty:{
                                    message:"Kehadiran harus di isi"
                                },
                                between:{
                                    min:1,
                                    max:10
                                },
                                integer:{
                                    message:'Harus angka bilangan bulat'
                                }
                            }
                        },
                        c2:{
                            message:"Inputan Tidak Valid",
                            validators:{
                                notEmpty:{
                                    message:"Motivasi Kerja harus di isi"
                                },
                                between:{
                                    min:1,
                                    max:10
                                },
                                integer:{
                                    message:'Harus angka bilangan bulat'
                                }
                            }
                        },
                        c3:{
                            message:"Inputan Tidak Valid",
                            validators:{
                                notEmpty:{
                                    message:"Komunikasi & Kerjasama harus di isi"
                                },
                                between:{
                                    min:1,
                                    max:10
                                },
                                integer:{
                                    message:'Harus angka bilangan bulat'
                                }
                            }
                        },
                        c4:{
                            message:"Inputan Tidak Valid",
                            validators:{
                                notEmpty:{
                                    message:"Pemahaman Pekerjaan harus di isi"
                                },
                                between:{
                                    min:1,
                                    max:10
                                },
                                integer:{
                                    message:'Harus angka bilangan bulat'
                                }
                            }
                        },
                        c5:{
                            message:"Inputan Tidak Valid",
                            validators:{
                                notEmpty:{
                                    message:"Pengembangan Diri harus di isi"
                                },
                                between:{
                                    min:1,
                                    max:10
                                },
                                integer:{
                                    message:'Harus angka bilangan bulat'
                                }
                            }
                        },
                        c6:{
                            message:"Inputan Tidak Valid",
                            validators:{
                                notEmpty:{
                                    message:"Pencapaian Target Kerja harus di isi"
                                },
                                between:{
                                    min:1,
                                    max:10
                                },
                                integer:{
                                    message:'Harus angka bilangan bulat'
                                }
                            }
                        }
                                               
                    }

                });
                 
                
            }            
function validasiBobot(){
                $("#form2").formValidation({
                    message: 'This value is not valid',
                    excluded: ':disabled',
                    icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                    },
                    fields:{

                       
                        bobotc1:{
                            message:"Inputan Tidak Valid",
                            validators:{
                                notEmpty:{
                                    message:"Bobot Kehadiran harus di isi"
                                },
                                between:{
                                    min:1,
                                    max:5
                                },
                                integer:{
                                    message:'Harus angka bilangan bulat'
                                }
                            }
                        },
                        bobotc2:{
                            message:"Inputan Tidak Valid",
                            validators:{
                                notEmpty:{
                                    message:"Bobot Motivasi Kerja harus di isi"
                                },
                                between:{
                                    min:1,
                                    max:5
                                },
                                integer:{
                                    message:'Harus angka bilangan bulat'
                                }
                            }
                        },
                        bobotc3:{
                            message:"Inputan Tidak Valid",
                            validators:{
                                notEmpty:{
                                    message:"Bobot Komunikasi & Kerjasama harus di isi"
                                },
                                between:{
                                    min:1,
                                    max:5
                                },
                                integer:{
                                    message:'Harus angka bilangan bulat'
                                }
                            }
                        },
                        bobotc4:{
                            message:"Inputan Tidak Valid",
                            validators:{
                                notEmpty:{
                                    message:"Bobot Pemahman Pekerjaan diri harus di isi"
                                },
                                between:{
                                    min:1,
                                    max:5
                                },
                                integer:{
                                    message:'Harus angka bilangan bulat'
                                }
                            }
                        },
                        bobotc5:{
                            message:"Inputan Tidak Valid",
                            validators:{
                                notEmpty:{
                                    message:"Bobot Pengembangan Diri harus di isi"
                                },
                                between:{
                                    min:1,
                                    max:5
                                },
                                integer:{
                                    message:'Harus angka bilangan bulat'
                                }
                            }
                        },
                        bobotc6:{
                            message:"Inputan Tidak Valid",
                            validators:{
                                notEmpty:{
                                    message:"Bobot Pencapaian Target Kerja harus di isi"
                                },
                                between:{
                                    min:1,
                                    max:5
                                },
                                integer:{
                                    message:'Harus angka bilangan bulat'
                                }
                            }
                        }
                                               
                    }

                });
                 
                
            }


            function add(){
                save_method='add';
                
                validasi();
                $('#form2').hide();
                $('#form')[0].reset();
                $('#form').show();
                $('#id_karyawan').show();
                $('#id_hide').hide();
                $('#modal_form').modal('show');
                $('.modal-title').text('Tambah Data Detail Nilai');
                
            }
            
            function edit_detail_nilai(id){
                save_method='update';
                validasi2();
                $('#form2').hide();
                $('#form')[0].reset();
                $('#form').show();
                $('#id_karyawan').hide();
                $('#id_hide').show();
                
                $.ajax({
                    url:"<?php echo site_url('Detail_nilai/ajax_edit/');?>/"+id,
                    type:"POST",
                    dataType: "json",
                    success: function (data) {
                        $('[name=id]').val(data.id_detail);
                        $('[name=id_karyawan]').val(data.id_karyawan);
                        $('#id_karyawan_hidden').val(data.id_karyawan);
                        $('[name=c1]').val(data.c1);
                        $('[name=c2]').val(data.c2);
                        $('[name=c3]').val(data.c3);
                        $('[name=c4]').val(data.c4);
                        $('[name=c5]').val(data.c5);
                        $('[name=c6]').val(data.c6);
                                              
                        
                        
                        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                        $('.modal-title').text('Edit Detail nilai'); // Set title to Bootstrap modal title
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }    
                });
            }
            
            function save(){
                    var url;
                    var idform;
                    if(save_method=='add'){
                        url="<?php echo site_url('Detail_nilai/ajax_add');?>";
                        idform='#form';
                    }
                    else if(save_method=='bobot'){
                        url="<?php echo site_url('Detail_nilai/updateBobot');?>";
                        idform='#form2';
                    }
                    else{
                        url="<?php echo site_url('Detail_nilai/ajax_update');?>";
                        idform='#form';
                    }
                    
                    $.ajax({
                        url:url,
                        type:"POST",
                        data:$(idform).serialize(),
                        dataType: "JSON",
                        success: function (data) {
                        //if success close modal and reload ajax table
                        $('#modal_form').modal('hide');
                        $('#modal_bobot').modal('hide');
                        reload_table();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                           // alert('Error adding / update data');
                        }
                        
                    });
            }
            

            function delete_detail_nilai(id){
            if(confirm('Are You Sure Delete this data??')){
                $.ajax({
                    url:"<?php echo site_url('Detail_nilai/ajax_delete');?>/"+id,
                    type:"POST",
                    dataType:"JSON",
                    success: function (data) {
                        
                        reload_table();
                    },
                    error: function (jqXHR, textStatus, errorThrown){
                        alert('Error Delete Data');
                    }
                    
                });
                }
            }



            function lihatBobot(id){
                save_method='bobot';
                $('#form').hide();
                $('#form2')[0].reset();
                $('#form2').show();
                validasiBobot();
               
                $.ajax({
                    url:"<?php echo site_url('Detail_nilai/lihatBobot/');?>/"+id,
                    type:"POST",
                    dataType: "json",
                    success: function (data) {
                        $('[name=id_penilaian]').val(data.id_penilaian);
                        
                        
                        $('[name=bobotc1]').val(data.bobot_c1);
                        $('[name=bobotc2]').val(data.bobot_c2);
                        $('[name=bobotc3]').val(data.bobot_c3);
                        $('[name=bobotc4]').val(data.bobot_c4);
                        $('[name=bobotc5]').val(data.bobot_c5);
                        $('[name=bobotc6]').val(data.bobot_c6);
                       
                        $('#modal_bobot').modal('show'); // show bootstrap modal when complete loaded
                        $('.modal-title').text('Edit Bobot'); // Set title to Bootstrap modal title
                        
                        
                        
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }    
                });
            }

    function pilih_karyawan(id){

        $.ajax({
            url:"<?php echo site_url('Karyawan/ambilKaryawan');?>/"+id,
            type:"POST",
            dataType:"json",
            success:function(data){
                $('[name=id_hide]').val(data.id_karyawan);
                $('[name=nama_karyawan]').val(data.nama_karyawan);
                $('[name=jabatan]').val(data.jabatan);

            },
            error:function(jqXHR, textStatus, errorThrown){
                alert('Error get data from ajax');
            }
        });
    }
            
        </script>

    <style type="text/css">
    .sorting_disabled{
        width: 130px;
    }
    thead tr th{
        background-color: #338ab8;
        color: #fff;
    }

    
    </style>


            <?php echo $tambah;?>
            <?php
            
                function jabatan($id){
                    $link=new mysqli("localhost","root","","db_fajarcirebon");
                    $q=$link->query("select posisi_jabatan from jabatan where id_jabatan='".$id."'");
                    $q=$q->fetch_object();
                    return $q->posisi_jabatan;
                }

                function ambilKaryawan($id){
                    $link=new mysqli("localhost","root","","db_fajarcirebon");
                    $q=$link->query("select nama_karyawan from karyawan where id_karyawan='".$id."'");
                    $q=$q->fetch_object();
                    return $q->nama_karyawan;
                }
                
               
            ?>

            
            <table id="table" class="table table-striped table-bordered table-responsive table-hover" cellspacing="0"  width="100%">
                <thead>
                    <tr>
                        <th>ID Karyawan</th>
                        <th>Nama Karyawan</th>
                        <th>Jabatan</th>
                        <th>C1</th>
                        <th>C2</th>
                        <th>C3</th>
                        <th>C4</th>
                        <th>C5</th>
                        <th>C6</th>
                        <th>Action</th>

                    </tr>
                </thead>
                
                <tbody>
                    
                </tbody>
                
                
                
            </table>
            <?php echo $tombol; ?>
 
        
        
        
    <!-- bootstrap modal-->
    <div class="modal fade bs-example-modal-lg" id="modal_form" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- header modal-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Form Data Detail_nilai</h3>
                </div>
                <!-- end of header modal-->



                <!-- body modal -->
                <div class="modal-body form">
                    <form action="#" id="form" class="form-horizontal">
                        <input type="hidden" name="id">
                        <input type="hidden" id="id_penilaian" name="id_penilaian" value="<?php echo $id;?>" >
                        <input type="hidden" name="id_karyawan_hidden">
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-4">ID Karyawan</label>
                                <div class="col-md-8">
                                    <select  id="id_karyawan" name="id_karyawan" class="form-control" onchange="pilih_karyawan(this.options[this.selectedIndex].value)">
                                        <option selected disabled="true">-</option>
                                        <?php
                                        foreach ($karyawan as $list) {
                                            echo "<option value='".$list->id_karyawan."'>(".$list->id_karyawan.") ".ambilKaryawan($list->id_karyawan)." / ".jabatan($list->id_jabatan)."</option>";
                                        }
                                        ?>
                                    </select>
                                    <input type="text" id="id_hide" name="id_hide" readonly="true" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Nama Karyawan</label>
                                <div class="col-md-8">
                                    <input id="nama_karyawan" name="nama_karyawan" class="form-control" type="text" placeholder="Nama Karyawan" readonly="true">
                                </div>
                            </div>                            
                           
                            <div class="form-group">
                                <label class="control-label col-md-4">Jabatan</label>
                                <div class="col-md-8">
                                    <input id="jabatan" name="jabatan" class="form-control" type="text" placeholder="Jabatan" readonly="true">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Kehadiran Karyawan (C1)</label>
                                <div class="col-md-8">
                                    <input id="c1" name="c1" class="form-control" type="text" maxlength="4" placeholder="Kehadiran Karyawan">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Motivasi Kerja (C2)</label>
                                <div class="col-md-8">
                                    <input id="c2" name="c2" class="form-control" type="text" maxlength="4" placeholder="Motivasi Kerja">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Komunikasi & Kerjasama (C3)</label>
                                <div class="col-md-8">
                                    <input id="c3" name="c3" class="form-control" type="text" maxlength="4" placeholder="Komunikasi & Kerjasama">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Pemahaman Pekerjaan (C4)</label>
                                <div class="col-md-8">
                                    <input id="c4" name="c4" class="form-control" type="text" maxlength="4" placeholder="Pemahaman Pekerjaan">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Pengembangan Diri (C5)</label>
                                <div class="col-md-8">
                                    <input id="c5" name="c5" class="form-control" type="text" maxlength="4" placeholder="Pengembangan Diri">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Pencapaian Target Kerja (C6)</label>
                                <div class="col-md-8">
                                    <input id="c6" name="c6" class="form-control" type="text" maxlength="4" placeholder="Pencapaian Target Kerja">
                                </div>
                            </div>


                            
                        </div>    

                <!-- end of body modal-->


                
                <!-- modal footer-->
                <div class="modal-footer">
                    <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
                <!-- end of modal footer-->
            </form>
            </div>
        </div>
    </div>
    </div>
        <!-- end modal bootstrap -->


<!-- bootstrap modal-->
    <div class="modal fade bs-example-modal-lg" id="modal_bobot" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- header modal-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Form Data Detail_nilai</h3>
                </div>
                <!-- end of header modal-->



                <!-- body modal -->
                <div class="modal-body form">
                 
                    <form action="#" id="form2" class="form-horizontal">
                        <input type="hidden"  name="id">
                        <input type="hidden" name="id_penilaian" value="<?php echo $id;?>" >
                        
                        <div class="form-body">
                            
                            
                            <div class="form-group">
                                <label class="control-label col-md-4">Kehadiran Karyawan (C1)</label>
                                <div class="col-md-8">
                                    <input id="bobotc1" name="bobotc1" class="form-control" type="text" maxlength="4" placeholder="Kehadiran Karyawan">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-4">Motivasi Kerja (C2)</label>
                                <div class="col-md-8">
                                    <input id="bobotc2" name="bobotc2" class="form-control" type="text" maxlength="4" placeholder="Motivasi Kerja">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Komunikasi & Kerjasama (C3)</label>
                                <div class="col-md-8">
                                    <input id="bobotc3" name="bobotc3" class="form-control" type="text" maxlength="4" placeholder="Komunikasi & Kerjasama">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Pemahaman Pekerjaan (C4)</label>
                                <div class="col-md-8">
                                    <input id="bobotc4" name="bobotc4" class="form-control" type="text" maxlength="4" placeholder="Pemahaman Pekerjaan">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Pengembangan Diri (C5)</label>
                                <div class="col-md-8">
                                    <input id="bobotc5" name="bobotc5" class="form-control" type="text" maxlength="4" placeholder="Pengembangan Diri">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-4">Pencapaian Target Kerja (C6)</label>
                                <div class="col-md-8">
                                    <input id="bobotc6" name="bobotc6" class="form-control" type="text" maxlength="4" placeholder="Pencapaian Target Kerja">
                                </div>
                            </div>


                        </div>    
                            
                          
                 
                    

                    


                
                <!-- end of body modal-->


                
                <!-- modal footer-->
                <div class="modal-footer">
                    <button type="submit" id="btnSave" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
                <!-- end of modal footer-->
            </form>
            </div>
        </div>
    </div>
    </div>
        <!-- end modal bootstrap -->


 


