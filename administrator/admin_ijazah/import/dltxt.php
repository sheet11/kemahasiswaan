<meta charset="utf-8">
<?php
$connect = mysqli_connect("localhost", "root", "", "phpsamples");
$file = fopen('upsoal.txt', 'w');
$query=mysqli_query($connect,"select * from upsoal");
$text='';
$no=1;
while($q=mysqli_fetch_array($query))
{

	$text.=trim(preg_replace('/[^\x00-\x7f£¢£€¥]+/u', '', $q['soal']),'&nbsp').PHP_EOL;
	$text.='A. '.' '.trim(preg_replace('/[^\x00-\x7f£¢£€¥]+/u', '', $q['a']),'&nbsp').PHP_EOL;
	$text.='B. '.' '.trim(preg_replace('/[^\x00-\x7f£¢£€¥]+/u', '', $q['b']),'&nbsp').PHP_EOL;
	$text.='C. '.' '.trim(preg_replace('/[^\x00-\x7f£¢£€¥]+/u', '', $q['c']),'&nbsp').PHP_EOL;
	$text.='D. '.' '.trim(preg_replace('/[^\x00-\x7f£¢£€¥]+/u', '', $q['d']),'&nbsp').PHP_EOL;
	$text.='E. '.' '.trim(preg_replace('/[^\x00-\x7f£¢£€¥]+/u', '', $q['e']),'&nbsp').PHP_EOL;
	$text.='ANSWER:'.' '.$q['j'].PHP_EOL;
	$no++;
}

fwrite($file , $text);  
fclose($file );  
echo "File berhasil di tulis";  
?>
<a href="upsoal.txt">Download</a>