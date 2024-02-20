<?php
include "config/koneksi.php";
if(isset($_GET['kirim']))
{
    if  (!empty($_GET["nim"]) AND 
         !empty($_GET["ijazah"]))
     
    {
        $nim = $_GET['nim'];
        $ijazah = $_GET['ijazah'];
    }
    $query  ="SELECT * FROM tb_ijazah WHERE nim='$nim' and no_seri_ijazah='$ijazah'";
    $result = mysql_query($query);
    while($row = mysql_fetch_array($result))
    {
        $data[] = $row;
        
    }
    if($data)
    {
        $response   =   array(
                        'status'    =>  1,
                        'message'   =>  'Success',
                        'data'      =>  $data        
        );
    }else {
        $response=array(
            'status'    => 0,
            'message'   => 'Failure'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
