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
                        "url":"<?php echo site_url('Penilaian/ajax_list/'.$id);?>",
                        "type":"POST"
                    },
                            
                    "columnDefs":[
                    {
                        "targets":[ -1],
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
                        id_penilaian:{
                            message: 'ID Penilaian Tidak Valid',
                            validators:{
                                notEmpty:{
                                    message: 'ID Penilaian harus di isi'
                                },
                                stringLength: {
                                    min: 1,
                                    max: 5,
                                    message: 'ID Jabatan harus lebih dari 1 dan kurang dari 6 digit'
                                },

                            }
                        },
                        waktu:{
                            message: 'Waktu Tidak Valid',
                            validators:{
                                notEmpty:{
                                    message: 'Waktu harus di isi dengan tahun'
                                },
                                between:{
                                min:2012,
                                max:<?php echo date("Y")+1;?>
                                
                                },
                                numeric:{
                                    message:'harus angka'
                                }
                            }
                        },
                        
                        keterangan:{
                            message: 'Keterangan harus di isi',
                            validators:{
                                notEmpty:{
                                    message: 'Keterangan Harus di isi'
                                },
                                regexp:{
                                    regexp: /^[0-9a-zA-Z\s]+$/i,
                                    message: 'Inputan hanya bisa untuk huruf dan angka'
                                }
                            }
                        }                        
                    }

                });
                
        }


            function add(){
                save_method='add';
                validasi();
                $('#form')[0].reset();
                $.ajax({
                    url:"<?php echo site_url('Penilaian/autoId/');?>",
                    type:"POST",
                    dataType:"json",
                    success: function(data){
                        $('[name=id_penilaian]').val(data.id_penilaian);
                    }
                });
                $('#modal_form').modal('show');
                $('.modal-title').text('Tambah Data Penilaian');
                
            }
            
            function edit_penilaian(id){
                save_method='update';
                validasi();
                $('#form')[0].reset();
                
                $.ajax({
                    url:"<?php echo site_url('Penilaian/ajax_edit/');?>/"+id,
                    type:"POST",
                    dataType: "json",
                    success: function (data) {
                        $('[name=id]').val(data.id_penilaian);
                        $('[name=id_penilaian]').val(data.id_penilaian);
                        $('[name=waktu]').val(data.waktu);
                        $('[name=keterangan').val(data.keterangan);
                        
                        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                        $('.modal-title').text('Edit Penilaian'); // Set title to Bootstrap modal title
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
                        url="<?php echo site_url('Penilaian/ajax_add');?>";
                        
                    }else{
                        url="<?php echo site_url('Penilaian/ajax_update');?>";
                        
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
                            //alert('Error adding / update data');
                        }
                        
                    });
            }
            
            function delete_penilaian(id){
            if(confirm('Are You Sure Delete this data??')){
                $.ajax({
                    url:"<?php echo site_url('Penilaian/ajax_delete');?>/"+id,
                    type:"POST",
                    dataType:"JSON",
                    success: function (data) {
                        window.location.assign('<?php echo current_url();?>');
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
                        url:"<?php echo site_url('Penilaian/aktifstatus');?>/"+id,
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
                        url:"<?php echo site_url('Penilaian/nonaktifstatus');?>/"+id,
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
       min-width: 250px;
        
    }

    .sorting_desc{
        width: 240px;
    }

    .sorting_asc{
        width: 240px;
    }
    .sorting{
        width: 220px;
    }
    thead tr th{
        background-color: #337ab7;
        color: #fff;
    }

    


    </style>


            <?php echo $tambah;?>
            
            
            <table id="table" class="table table-striped table-bordered table-hover table-responsive" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        
                        <th>ID Penilaian</th>
                        <th>Waktu</th>
                        <th>Keterangan</th>
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
                    <h3 class="modal-title">Form Data Penilaian</h3>
                </div>
                <!-- end of header modal-->
                
                <!-- body modal -->
                <div class="modal-body form">
                    <form action="#" id="form" class="form-horizontal">
                        <input type="hidden"  name="id">
                        
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">ID Penilaian</label>
                                <div class="col-md-9">
                                    <input readonly="true" id="id_penilaian" name="id_penilaian" class="form-control" type="text" placeholder="ID Penilaian">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-md-3">Waktu</label>
                                <div class="col-md-9">
                                    <input  id="waktu" name="waktu" class="form-control" type="text" maxlength="4" placeholder="tahun">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-md-3">Keterangan</label>
                                <div class="col-md-9">
                                    <input  id="keterangan" name="keterangan" class="form-control" type="text" placeholder="Keterangan" maxlength="40">
                                </div>
                            </div>
                           
                            
                    
                </div>
                <!-- end of body modal-->
                
                <!-- modal footer-->
                <div class="modal-footer">
                    <button type="submit" id="btnSave"  class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
                <!-- end of modal footer-->
            </form>
            </div>
        </div>
    </div>
    </div>
        <!-- end modal bootstrap -->
   