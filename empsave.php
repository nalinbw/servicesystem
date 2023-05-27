 <?php 
  
include("dbase.php");

$log=$_COOKIE["login"] ; $ux=explode(":",$log);
$cpid=$ux[1];
$str1 ="select c.sno ,brand  from company as c inner join sup as s on c.sno=s.sno  where  c.cpid=$ux[1]";
$rs41 = $bdd->query($str1) or die( "error on -$str1");  	
$row41=$rs41->fetch();
$sno=$row41[0];
$brand=$row41[1];

 // 
//sup
	  
	  $val1 = $_POST["vals"];  
	  $icode=intval($val1[2]);
	  $bcode=($val1[2]=="")?"No code":$val1[2];
	  $cost=floatval($val1[3]);
	  $sale=floatval($val1[4]);
	  $vol=1;
	  
	  
	 
	 if($val1[1]=="") {
		
		  $ln= "<div class='alert alert-danger' role='alert'>  Add an Employee Name       </div>";
		  echo "$ln";
			exit();
	 }

     $str1 ="select * from cusemp where cpid=$cpid and cname='$val1[1]' and cno <> $val1[8]";
	 $rs2 = $bdd->query($str1) or die( "error on -$str1");
	  if($rs2->rowCount()>0) {
		$ln= "<div class='alert alert-danger' role='alert'>  $val1[1] is already existing       </div>";
		echo "$ln";
		exit();

	 }

	  
		//max icode 
	  $str1 ="select cno  from cusemp  where cpid=$cpid  order by  cno desc";
     $rs1 = $bdd->query($str1) or die( "error on -$str1");
	 $row1=$rs1->fetch(); 
	 $cno=($val1[8]==0)?$row1[0]+1:$val1[8];  
	 $str1 ="delete from  cusemp where cpid=$cpid and cno=$cno";
	 $rs31 = $bdd->query($str1) or die( "error on -$str1");  
	 
	 $str1 ="insert into cusemp values($cpid,$cno,'$val1[1]','.','..','emp','None','$date1','$date1',1)";
	 $rs3 = $bdd->query($str1) or die( "error on -$str1");    
		  
	 $str1 ="delete from  empdata where cpid=$cpid and cno=$cno";
	 $rs41 = $bdd->query($str1) or die( "error on -$str1");  
	 
	 $str1 ="insert into empdata values($cpid,$cno,'$val1[3]','$val1[4]','$val1[6]','$val1[7]','$val1[2]','$val1[5]')";
	 $rs4= $bdd->query($str1) or die( "error on -$str1");    
	  
	  
	  $ln= "<div class='alert alert-success' role='alert'> Save -  $val1[1]      </div>";
      echo "$ln";

 ?>