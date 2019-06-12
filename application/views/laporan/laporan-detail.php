<html>
<head>

<style type="text/css">
    *{
        font-family: times;
        font-size: 14px;
    }

    table{
        border-collapse: collapse;
    }

    table tr th{
        padding: 8px;
        border: 0.5px solid #000;
        background-color: #c9e3f1;
        font-size: 12px;
    }
    table tr td{
        padding: 8px;
        border: 0.5px solid #000;
        font-size: 12px;
    }
    table tr:nth-child(odd) {
      background-color: #f9f9f9;
    }
    .sign {
        position: absolute;
        margin-top: 40px;
        right: 60px;
        
    }


</style>

</head>
<body>



<b>Laporan Penilaian Kinerja Karyawan <br>Harian Umum Fajar Cirebon <br>Tahun <?php echo $this->MPenilaian->get_by_id($id)->waktu;?></b>
<hr width="100%" style="height:4px;">
<b>1. Daftar Nilai Kinerja Karyawan</b>
        <table align="center" width="100%">
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

                </tr>
            </thead>
            <tbody>
            <?php

            foreach ($tampil as $data) {
        	echo "<tr>
                      <td>".$data->id_karyawan."</td>
        			  <td>".$this->MKaryawan->ambilKaryawan($data->id_karyawan)->nama_karyawan."</td>
                      <td>".$this->MJabatan->ambilJabatan($this->MKaryawan->ambilKaryawan($data->id_karyawan)->id_jabatan)->posisi_jabatan."</td>
        			  <td>".$data->c1."</td><td>".$data->c2."</td><td>".$data->c3."</td>
        			  <td>".$data->c4."</td><td>".$data->c5."</td><td>".$data->c6."</td>
                      </tr>";
            }
            ?>
            </tbody>
        </table>



<br>
<b>2. Normalisasi Nilai Kinerja Karyawan</b>
        <table align="center" width="100%">
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
                </tr>
            </thead>
            <tbody>
            <?php

            foreach ($tampil2 as $data) {
                $c1=$data->C1==1?"<b>1</b>":$data->C1;
                $c2=$data->C2==1?"<b>1</b>":$data->C2;
                $c3=$data->C3==1?"<b>1</b>":$data->C3;
                $c4=$data->C4==1?"<b>1</b>":$data->C4;
                $c5=$data->C5==1?"<b>1</b>":$data->C5;
                $c6=$data->C6==1?"<b>1</b>":$data->C6;

                



            echo "<tr>
                      <td>".$data->id_karyawan."</td>
                      <td>".$this->MKaryawan->ambilKaryawan($data->id_karyawan)->nama_karyawan."</td>
                      <td>".$this->MJabatan->ambilJabatan($this->MKaryawan->ambilKaryawan($data->id_karyawan)->id_jabatan)->posisi_jabatan."</td>
                      <td>".$c1."</td><td>".$c2."</td><td>".$c3."</td>
                      <td>".$c4."</td><td>".$c5."</td><td>".$c6."</td>
                      </tr>";
            }
            ?>
            </tbody>
        </table>        


<br>
<b>3. Nilai Akhir Kinerja Karyawan</b>
        <table align="center" width="100%">
            <!-- <caption><h3>Nilai Akhir Kinerja Karyawan</h3></caption> -->
            <thead>

                <tr>
                    <th>ID Karyawan</th>
                    <th>Nama Karyawan</th>
                    <th>Jabatan</th>
                    <th>Total</th>
                    <th>Ranking</th>
                </tr>
            </thead>
            <tbody>
            <?php

            foreach ($tampil3 as $data) {
            echo "<tr>
                      <td>".$data->id_karyawan."</td>
                      <td>".$this->MKaryawan->ambilKaryawan($data->id_karyawan)->nama_karyawan."</td>
                      <td>".$this->MJabatan->ambilJabatan($this->MKaryawan->ambilKaryawan($data->id_karyawan)->id_jabatan)->posisi_jabatan."</td>
                      <td>".$data->Total."</td><td>".$data->ranking."</td>
                      </tr>";
            }
            ?>
            </tbody>
        </table>
        
        <div class="sign">Cirebon, <?php $tgl=date("d F Y");
        echo $tgl ;?>
        <br>
        <br>
        <br>
        <br>
        <br>
        &nbsp;&nbsp;&nbsp;Manajer Personalia
        </div>


</body>
</html>