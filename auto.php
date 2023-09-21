<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<style>
	div{
		font-size:25px;
	}
</style>
<body>
	<form action="auto.php" method="post" name="form1" id="form1">
	<p>
	<input type="submit" name="submit" id="submit" value="提交">
	</p>
	</form>
</body>
</html>


<?php
	session_start();
	//隨機產生3數

	echo "<div>";
	if(isset($_POST["submit"])){
			$arr = array();
			while(count($arr) < 3){
				$ran = rand(0,9);
				if(!in_array($ran,$arr)){
					$arr[] = $ran;
				}
			}
			
			$_SESSION['arr'] = $arr;

			if(!isset($_SESSION['count'])){
				$_SESSION['count'] = 1;
			}
			else{
				$_SESSION['count'] += 1;
			} //計算次數

			if(!isset($_SESSION['ans'])){
				$_SESSION['ans'] = "";
			}

			if(!isset($_SESSION['check'])){
				$_SESSION['check'] = 1;
			}
			else{
				$_SESSION['check'] = 2;
			}
			
            if(isset($_SESSION['check'])){ //按第一下
                if($_SESSION['check'] == 1){
                    $result = abs($_SESSION['arr'][1] - $_SESSION['arr'][0]) ==  abs($_SESSION['arr'][2] - $_SESSION['arr'][1]); 

                    $_SESSION['ans'] .= $_SESSION['count']." = ";
                    for($i=0;$i<count($_SESSION['arr']);$i++){
                        $_SESSION['ans'] .= $_SESSION['arr'][$i].",";
                    }
                    $_SESSION['ans'] .= "</br>";
                    
                    if($_SESSION['count'] <= 9){
                        if($result){
                            $_SESSION['ans'] .= "總共試了".$_SESSION['count']."次或成功";
                            session_destroy();
                        }
                    }
                    else{
                        $_SESSION['ans'] .= "總共試了".$_SESSION['count']."次或成功";
                        session_destroy();
                    }
                }
            }
	}
	
	if(isset($_SESSION['check'])){
		if($_SESSION['check'] == 2){
            for($i=0;$i<8;$i++){
                $arr = array();
                while(count($arr) < 3){
                    $ran = rand(0,9);
                    if(!in_array($ran,$arr)){
                        $arr[] = $ran;
                    }
                }
                $_SESSION['arr'] = $arr;
                
                $result = abs($_SESSION['arr'][1] - $_SESSION['arr'][0]) ==  abs($_SESSION['arr'][2] - $_SESSION['arr'][1]);
                $_SESSION['ans'] .= $_SESSION['count']." = ";

                for($i=0;$i<count($_SESSION['arr']);$i++){
                    $_SESSION['ans'] .= $_SESSION['arr'][$i].",";
                }
                $_SESSION['ans'] .= "</br>";
                
                if($_SESSION['count'] <= 9){
                    if($result){
                        $_SESSION['ans'] .= "總共試了".$_SESSION['count']."次或成功";
                        session_destroy();
                        break;
                    }
                }
                else{
                    $_SESSION['ans'] .= "總共試了".$_SESSION['count']."次或成功";
                    session_destroy();
                    break;
                }
                $_SESSION['count']++;
            }

			print_r($_SESSION['ans']);
		}
		else{
            
			print_r($_SESSION['arr']);
			echo "</br>";
		}
	}
	echo "</div>";
	//session_destroy();

?>