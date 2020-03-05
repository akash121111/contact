<?php	






include("db.php");
$db = new dbObj();
$connection =  $db->getConnstring();

$request_method=$_SERVER["REQUEST_METHOD"];



	switch($request_method)
		{
			case 'POST':
			// Insert message
			contact();
			break;
			default:
				// Invalid Request Method
				header("HTTP/1.0 405 Method Not Allowed");
				break;
		}


			function contact()
				{
					global $connection;
			 
					$data = json_decode(file_get_contents('php://input'), true);
					$name=$data["name"];
					$email=$data["email"];
					$contact_us=$data["contact_us"];
					$message=$data["message"];

					echo $query="INSERT INTO contact_info SET name='".$name."', email='".$email."', contact_us='".$contact_us."', message='".$message."'";
					if(mysqli_query($connection, $query))
					{
						$response=array(
							'status' => 1,
							'status_message' =>'message send succesfully.'
						);
					}
					else
					{
						$response=array(
							'status' => 0,
							'status_message' =>'We regret for the inconvinenece caused.'
						);
					}
					header('Content-Type: application/json');
					echo json_encode($response);
				

			}

?>
