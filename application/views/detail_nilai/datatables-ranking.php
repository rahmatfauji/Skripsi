
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
                        "url":"<?php echo site_url('Detail_nilai/ajax_list3/'.$id);?>",
                        "type":"POST"
                    },
        
                    "columnDefs":[
                    {
                        "targets":[ 1,2 ],
                        "orderable":false,
                    },
                    ],
                });
            });
            
            function reload_table()
            {
              table.ajax.reload(null,false); //reload datatable ajax 
            }
            
            

            
</script>

    <style type="text/css">
    .sorting_disabled{
        width: 160px;
    }
    .sorting_asc, .sorting_desc{
        width: 130px;
    }
    thead tr th{
        background-color: #338ab8;
        color: #fff;
    }
    </style>


           
            
            
            <table id="table" class="table table-striped table-bordered table-responsive table-hover" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID Karyawan</th>
                        <th>Nama Karyawan</th>
                        <th>Jabatan</th>
                        <th>Total Nilai</th>
                        <th>Ranking</th>
                    </tr>
                </thead>
                
                <tbody>
                    
                </tbody>
                
                
                
            </table>
            <?php echo $tombol; ?>
 
        

        
        
   


 


