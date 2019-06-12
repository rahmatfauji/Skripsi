
<script type="text/javascript">
            var save_method;
            var table;
            $(document).ready(function(){
                table=$('#table').DataTable({
                    "processing":false,
                    "serverSide":true,
                    "searching":false,
                    "aaSorting":[[0,'asc']],
                    "lengthMenu":[ [5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
                    "ajax":{
                        "url":"<?php echo site_url('Karyawan/ajax_list/'.$id);?>",
                        "type":"POST"
                    },
                            
                    "columnDefs":[
                    {
                        "targets":[4, -1 ],
                        "orderable":false,
                    },
                    ],
                });

                //agar ketika tekan tombol enter, form terkirim normal
                $("#form").submit(function( event ) {
                  save();
                  event.preventDefault();
                });

                //agar ketika close validasi di hilangkan
                $('#modal_form').on('hidden.bs.modal', function() {
                    $("#form").formValidation("destroy");
                });

            });
            
            function reload_table()
            {
              table.ajax.reload(null,false); //reload datatable ajax 
            }
            
            function validasi(){
                $("#form").formValidation({
                    message: 'This value is not valid',
                    icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                    },
                    fields:{
                        id_karyawan:{
                            message: 'ID Karyawan Tidak Valid',
                            validators:{
                                notEmpty:{
                                    message: 'ID Karyawan harus di isi'
                                },
                                stringLength: {  
                                    max: 12,
                                    message: 'ID Karyawan maksimal 12 digit'
                                },
                                remote:{
                                    type:'post',
                                    url:'<?php echo base_url();?>Karyawan/cekAvailable',
                                    message:'ID Karyawan sudah digunakan'
                                },
                                regexp:{
                                    regexp: /^[0-9][0-9][0-9][0-9][-'-'\s][0-9][0-9][-'-'\s][0-9][0-9][0-9][0-9]$/i,
                                    message: 'Format harus 0000-00-0000'
                                }
                            }
                        },
                        nama:{
                            message: 'Nama Tidak Valid',
                            validators:{
                                notEmpty:{
                                    message: 'nama harus di isi'
                                },
                                stringLength: {
                                    min: 1,
                                    max: 30,
                                    message: 'nama harus di isi 1-30 digit'
                                },
                                regexp:{
                                    regexp: /^[0-9a-zA-Z\s]+$/i,
                                    message: 'Inputan hanya bisa untuk huruf dan angka'
                                }
                            }
                        },
                        alamat:{
                            message: 'Alamat Tidak Valid',
                            validators:{
                                notEmpty:{
                                    message: 'Alamat harus di isi'
                                },
                                stringLength: {
                                    min: 1,
                                    max: 30,
                                    message: 'Alamat harus di isi 1-30 digit'
                                },
                                regexp:{
                                    regexp: /^[0-9a-zA-Z\s]+$/i,
                                    message: 'Inputan hanya bisa untuk huruf dan angka'
                                }
                            }
                        },
                        jk:{
                            message: 'Jenis Kelamin Tidak Valid',
                            validators:{
                                notEmpty:{
                                    message: 'Jenis Kelamin harus di isi'
                                }
                            }
                        },
                        jabatan:{
                            message: 'Jabatan Tidak Valid',
                            validators:{
                                notEmpty:{
                                    message: 'Jabatan harus di isi'
                                }
                            }
                        }                        
                    }

                });
                
            }


            function validasi2(id){
                
                $("#form").formValidation({
                    message: 'This value is not valid',
                    icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                    },
                    fields:{
                        id_karyawan:{
                            message: 'ID Karyawan Tidak Valid',
                            validators:{
                                notEmpty:{
                                    message: 'ID Karyawan harus di isi'
                                },
                                stringLength: {
                                    max: 12,
                                    message: 'ID Karyawan maksimal 12 digit'
                                },
                                remote:{
                                    type:'post',
                                    url:'<?php echo base_url();?>Karyawan/cekAvailable2/'+id,
                                    message:'ID Karyawan sudah digunakan'                    
                                },
                                regexp:{
                                    regexp: /^[0-9][0-9][0-9][0-9][-'-'\s][0-9][0-9][-'-'\s][0-9][0-9][0-9][0-9]$/i,
                                    message: 'Format harus 0000-00-0000'
                                }
                            }
                        },
                        nama:{
                            message: 'Nama Tidak Valid',
                            validators:{
                                notEmpty:{
                                    message: 'nama harus di isi'
                                },
                                stringLength: {
                                    min: 1,
                                    max: 30,
                                    message: 'nama harus di isi 1-30 digit'
                                },
                                regexp:{
                                    regexp: /^[0-9a-zA-Z\s]+$/i,
                                    message: 'Inputan hanya bisa untuk huruf dan angka'
                                }
                            }
                        },
                        alamat:{
                            message: 'Alamat Tidak Valid',
                            validators:{
                                notEmpty:{
                                    message: 'Alamat harus di isi'
                                },
                                stringLength: {
                                    min: 1,
                                    max: 30,
                                    message: 'Alamat harus di isi 1-30 digit'
                                },
                                regexp:{
                                    regexp: /^[0-9a-zA-Z\s]+$/i,
                                    message: 'Inputan hanya bisa untuk huruf dan angka'
                                }
                            }
                        },
                        jk:{
                            message: 'Jenis Kelamin Tidak Valid',
                            validators:{
                                notEmpty:{
                                    message: 'Jenis Kelamin harus di isi'
                                }
                            }
                        },
                        jabatan:{
                            message: 'Jabatan Tidak Valid',
                            validators:{
                                notEmpty:{
                                    message: 'Jabatan harus di isi'
                                }
                            }
                        }                        
                    }

                });
                
            }
            function add(){
                save_method='add';
                $('#form')[0].reset();
                $('#id_karyawan')[0].removeAttribute("readonly");
                $('#modal_form').modal('show');
                $('.modal-title').text('Tambah Data Karyawan');
                validasi();
                
            }
            
            function edit_karyawan(id){
                save_method='update';
                $('#form')[0].reset();
                //$('#id_karyawan')[0].setAttribute("readonly","true");
                validasi2(id);
                $.ajax({
                    url:"<?php echo site_url('Karyawan/ajax_edit/');?>/"+id,
                    type:"POST",
                    dataType: "json",
                    success: function (data) {
                        $('[name=id]').val(data.id_karyawan);
                        $('[name=id_karyawan]').val(data.id_karyawan);
                        $('[name=nama]').val(data.nama_karyawan);
                        $('[name=alamat').val(data.alamat);
                        $('[name=jk]').val(data.jk);
                        $('[name=jabatan]').val(data.id_jabatan);
                        $('[name=status]').val(data.status_karyawan);
                        
                        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                        $('.modal-title').text('Edit Karyawan'); // Set title to Bootstrap modal title
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error get data from ajax');
                    }    
                });
            }
            
            function save(){
                    var url;
                    if(save_method=='add'){
                        url="<?php echo site_url('Karyawan/ajax_add');?>";
                    }else{
                        url="<?php echo site_url('Karyawan/ajax_update');?>";
                    }
                    
                    $.ajax({
                        url:url,
                        type:"POST",
                        data:$('#form').serialize(),
                        dataType: "JSON",
                        success: function (data) {
                        //if success close modal and reload ajax table
                        $('#modal_form').modal('hide');
                        reload_table();
                        
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                          // alert('Error adding / update data');
                        }
                        
                    });
            }
            
            function delete_karyawan(id){
            if(confirm('Are You Sure Delete this data??')){
                $.ajax({
                    url:"<?php echo site_url('Karyawan/ajax_delete');?>/"+id,
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

            function aktifstatus(id){
                if(confirm('Yakin ingin mengaktifkan data ini??')){
                    $.ajax({
                        url:"<?php echo site_url('Karyawan/aktifstatus');?>/"+id,
                        type:"POST",
                        dataType:"JSON",
                        success: function(data){
                            reload_table()
                        },
                        error:function(jqXHR, textStatus, errorThrown){
                            alert('Error aktif status');
                        }
                    });
                }
            }

            function nonaktifstatus(id){
                if(confirm('Yakin ingin menonktifkan data ini??')){
                    $.ajax({
                        url:"<?php echo site_url('Karyawan/nonaktifstatus');?>/"+id,
                        type:"POST",
                        dataType:"JSON",
                        success: function(data){
                            reload_table()
                        },
                        error:function(jqXHR, textStatus, errorThrown){
                            alert('Error nonaktif status');
                        }
                    });
                }
            }

        
</script>

    <style type="text/css">
    .sorting_disabled{
        width: 150px;
    }

    .sorting, .sorting_asc, .sorting_desc{
        max-width: 150px;
    }
    thead tr th{
        background-color: #337ab7;
        color: #fff;
    }

    .table{

    }

    </style>


            <?php echo $tambah;?>
            
            
            <table id="table" class="table table-striped table-bordered table-responsive table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID Karyawan</th>
                        <th>Nama Karyawan</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Jabatan</th>
                        <th>Action</th>

                    </tr>
                </thead>
                
                <tbody>
                    
                </tbody>
                
                
                
            </table>
            <?php echo $tombol; ?>
 
        
        
        
    <!-- bootstrap modal-->
    <div class="modal fade" id="modal_form" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- header modal-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Form Data Karyawan</h3>
                </div>
                <!-- end of header modal-->
                
                <!-- body modal -->
                <div class="modal-body form">
                    <form id="form" class="form-horizontal">
                        <input id="id_karyawan_hidden" type="hidden" name="id">
                        
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">ID Karyawan</label>
                                <div class="col-md-9">
                                    <input id="id_karyawan" name="id_karyawan" class="form-control" type="text"  maxlength="12" placeholder="ID Karyawan">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-md-3">Nama Karyawan</label>
                                <div class="col-md-9">
                                    <input id="nama" name="nama" class="form-control" type="text" placeholder="Nama" maxlength="30">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-md-3">Alamat</label>
                                <div class="col-md-9">
                                    <input id="alamat" name="alamat" class="form-control" type="text" placeholder="Alamat" maxlength="30">
                                </div>
                            </div>
                           
                            
                            <div class="form-group">
                                <label class="control-label col-md-3">Jns.kelamin</label>
                                <div class="col-md-9">
                                    <select id="jk" name="jk" class="form-control">
                                        <option selected="true" value="">Jenis Kelamin</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <label class="control-label col-md-3">Jabatan</label>
                                <div class="col-md-9">
                                    <select id="jabatan" class="form-control" name="jabatan">
                                    <option selected="true" value="">Jabatan</option>
                                        <?php
                                            foreach ($jabatan as $list){
                                                echo "<option value='".$list->id_jabatan."'>".$list->posisi_jabatan."</option>";
                                            }

                                        ?>
                                       
                                    </select>
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
   