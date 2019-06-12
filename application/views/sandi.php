<?php
$id=$this->session->userdata('userid');


 ?>

<script type="text/javascript">
$(document).ready(function(){
    //agar ketika tekan tombol enter, form terkirim normal
    $("#form3").submit(function( event ) {
      ganti();
      event.preventDefault();
    });

    //agar ketika close validasi di hilangkan
    $('#modal_sandi').on('hidden.bs.modal', function() {
        $("#form3").formValidation("destroy");
        
    });

    });

    function gantisandi(){
        var id;
        id=<?php echo $id;?>;
        save_method='password';
        validasisandi();
        document.getElementById('formlg').className='modal-dialog';
        $('#form3')[0].reset();
        $('#form3').show();
        $('#modal_sandi').modal('show');
        $('.modal-title').text('Ganti Password');
        $.ajax({
            url:"<?php echo site_url('Admin/cekusername/');?>/"+id,
            type:"POST",
            dataType: "json",
            success: function (data) {
               $('[name=id_user]').val(data.id_user);
               $('[name=username]').val(data.username); 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });

        }

    function ganti(){
            var url;
            var idform;
            if(save_method=='password'){
                url="<?php echo site_url('admin/gantisandi');?>";
                idform='#form3';
            }
            
            $.ajax({
                url:url,
                type:"POST",
                data:$(idform).serialize(),
                dataType: "JSON",
                success: function (data) {
                //if success close modal and reload ajax table
                $('#modal_sandi').modal('hide');
                
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                //    alert('Ganti Password gagal');
                }
                
            });
    }

        function validasisandi(){
            $("#form3").formValidation({
                message: 'This value is not valid',
                excluded: ':disabled',
                icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
                },
                fields:{
                    username:{
                        message:'Username harus diisi',
                        validators:{
                            notEmpty:{
                                message:'Username harus diisi'
                            },
                            stringLength:{
                                min:5,
                                message:'Username minimal 5 digit'
                            },
                            regexp:{
                                    regexp: /^[0-9a-zA-Z\s]+$/i,
                                    message: 'Inputan hanya bisa untuk huruf dan angka'
                                }
                        }
                    },
                    passlama:{
                        message:'Password Lama Salah',
                        validators:{
                            notEmpty:{
                                message:'password lama harus di isi'
                            },
                            remote:{
                                type:'post',
                                url:'<?php echo base_url();?>admin/ceksandi',
                                message:'Password yang anda masukan salah'

                            }
                        }
                    },
                    passbaru:{
                        message:'Password baru salah',
                        validators:{
                            notEmpty:{
                                message:'Password baru harus di isi'
                            },
                            stringLength:{
                                min:8,
                                message:'Password baru minimal 8 karakter'
                            }
                        }
                    },
                    repass:{
                        message:'Password tidak cocok',
                        validators:{
                            notEmpty:{
                                message:'Password harus di isi'
                            },
                            identical: {
                            field: 'passbaru',
                            message: 'Password yang dimasukkan tidak sama'
                    }
                        }                        
                    }
                }

            });
             
            
        }           

</script>

<!-- <button type="button" href="javascript:void()" onclick="gantisandi()" class="btn btn-success"></button> -->

     
    <!-- bootstrap modal-->
    <div class="modal fade" id="modal_sandi" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" id="formlg">
            <div class="modal-content">
                <!-- header modal-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Form Data Jabatan</h3>
                </div>
                <!-- end of header modal-->
                
                <!-- body modal -->
                <div class="modal-body form">
                    <form action="#" id="form3" class="form-horizontal">
                        <input type="hidden" name="id_user">
                      
                        <div class="form-body">
                           <div class="form-group">
                                <label class="control-label col-md-3">Username</label>
                                <div class="col-md-9">
                                    <input id="username" name="username" class="form-control" type="text" placeholder="username" maxlength="20">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Password Lama</label>
                                <div class="col-md-9">
                                    <input id="passlama" name="passlama" class="form-control" type="password" placeholder="Password Lama">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-md-3">Password Baru</label>
                                <div class="col-md-9">
                                    <input id="passbaru" name="passbaru" class="form-control" type="password" maxlength="25" placeholder="Password Baru">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Ulangi Password</label>
                                <div class="col-md-9">
                                    <input id="repass" name="repass" class="form-control" type="password" maxlength="25" placeholder="Ulangi Password Baru">
                                </div>
                            </div>                            
                          
                    
                </div>
                <!-- end of body modal-->
                
                <!-- modal footer-->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
                <!-- end of modal footer-->
            </form>
            </div>
        </div>
    </div>
    </div>
        <!-- end modal bootstrap -->