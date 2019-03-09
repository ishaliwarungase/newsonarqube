<?php 

class v1{

	public static function headers (){
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST');
		header('Access-Control-Max-Age: 1000');
		header("Access-Control-Allow-Credentials: true");
		header('Access-Control-Allow-Headers:Content-Type, Accept, X-Requested-With, Session, Content-Range, Content-Disposition, Content-Description ');
	}

	/////////insta_image///////
	public static function trending_posts(){
		require_once realpath(__DIR__).'/../config/config.php';

		$json = json_decode(file_get_contents('php://input'),true);

		function scrape_insta_hash($tag) {
			$insta_source = file_get_contents('https://www.instagram.com/explore/tags/'.$tag.'/');
			$shards = explode('window._sharedData = ', $insta_source);
			$insta_json = explode(';</script>', $shards[1]); 
			return json_decode($insta_json[0], TRUE);
		}

		$results_array = scrape_insta_hash($data['hashtag']);
		$data_array = array();

		for ($i= 0; $i < $data['trending_count']; $i++) { 
				// $lik = mt_rand(1000,10000);
			$lik = $results_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'][$i]['node']['edge_liked_by']['count'];
			$img = $results_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'][$i]['node']['display_url'];

			array_push($data_array, array("img_list" => $img, "like_list" => $lik));
		}

		$res['st'] = 1; 
		$res['data'] = $data_array;

		self::headers();
		echo json_encode($res);
		exit(0);
	}


	/////////posts////////
	public static function posts(){
		require_once realpath(__DIR__).'/../config/config.php';

		$json = json_decode(file_get_contents('php://input'),true);

				// $from = $json['from'];
				// $to = $json['to'];

		function scrape_insta_hash($tag) {
			$insta_source = file_get_contents('https://www.instagram.com/explore/tags/'.$tag.'/');
			$shards = explode('window._sharedData = ', $insta_source);
			$insta_json = explode(';</script>', $shards[1]); 
			return json_decode($insta_json[0], TRUE);
		}

		$results_array = scrape_insta_hash($data['hashtag']);
		$data_array = array();

		for ($i= 0; $i < $data['trending_count']; $i++) { 
				// $lik = mt_rand(1000,10000); 
			$lik = $results_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'][$i]['node']['edge_liked_by']['count'];
			$img = $results_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'][$i]['node']['display_url'];

			array_push($data_array, array("img_list" => $img, "like_list" => $lik));
		}

		$res['st'] = 1; 
		$res['data'] = $data_array;

		self::headers();
		echo json_encode($res);
		exit(0);
	}


	/////////detail_posts////////
	public static function detail_post(){
		require_once realpath(__DIR__).'/../config/config.php';

		$json = json_decode(file_get_contents('php://input'),true);

				// $from = $json['from'];
				// $to = $json['to'];

		function scrape_insta_hash($tag) {
			$insta_source = file_get_contents('https://www.instagram.com/explore/tags/'.$tag.'/');
			$shards = explode('window._sharedData = ', $insta_source);
			$insta_json = explode(';</script>', $shards[1]); 
			return json_decode($insta_json[0], TRUE);
		}

		$results_array = scrape_insta_hash($data['hashtag']);
		$data_array = array();

		for ($i= 0; $i < $data['trending_count']; $i++) { 
				$lik = mt_rand(1000,10000);	 //$results_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'][$i]['node']['edge_liked_by']['count'];
				$img = $results_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'][$i]['node']['display_url'];

				array_push($data_array, array("img_list" => $img, "like_list" => $lik));
			}

			$res['st'] = 1; 
			$res['data'] = $data_array;

			self::headers();
			echo json_encode($res);
			exit(0);
		}



		///////Get token///////////////
		public static function get_token(){
			require_once realpath(__DIR__).'/../config/config.php';
			$json = json_decode(file_get_contents('php://input'),true);
			$db = conn();

			if(!empty($json['token'])){

				$token = trim($json['token'], '"');
				$qr = $db->prepare("SELECT id FROM  nmba_token WHERE token = '$token' LIMIT 1 ");
				$qr->execute();

				if ($qr->rowCount() == 0) {

					$qr = $db->prepare("INSERT INTO nmba_token(token) VALUES ('$token')");
					$qr->execute();
					
					if ($qr->rowCount() > 0) {
						$res['st'] = 1;
						$res['msg'] = 'Successfully added token';
					}else{
						$res['st'] = 2;
						$res['msg'] = 'Oops, error occured while adding user';
					}
				}else{
					$res['st'] = 3;
					$res['msg'] = 'Oops,Token already exists';
				}

			}else{

				$res['st'] = 4;
				$res['msg'] = 'some field empty';
				
			}

			self::headers();
			echo json_encode($res);

		}


		///////send notification/////////
		public static function send_notification(){
			require_once realpath(__DIR__).'/../config/config.php';
			$json = json_decode(file_get_contents('php://input'),true);
			$db = conn();

			if(!empty($json['title']) && !empty($json['message'])){

				$title = htmlspecialchars(stripslashes(strip_tags(trim(substr($json['title'], 0, 1000)))));
				$message = htmlspecialchars(stripslashes(strip_tags(trim(substr($json['message'], 0, 500)))));
				
				$qr = $db->prepare("SELECT id, token FROM nmba_token");

				$result = $qr->execute();

				if ($qr->rowCount() > 0) {
					$i = 0;

					while ($r = $qr->fetch(PDO::FETCH_ASSOC)) {

						$fields = array();
						$api_access_key = "AAAAoqjJe3g:APA91bHFtVA8la3z86KKJMjW4Pqi6mZILOB6EaYRk2fx_eXdj55XY66pe7UX3KxLT_6VevZSL-nL1V2zrjAATFOk02LpSO07oA_noJ295uwjJgVfz7UQnkGcRPrx7u3Yj9HnGW_bfN_i";//NMBA KEY

						$api_access_url = "https://fcm.googleapis.com/fcm/send";

						$fields['to'] = $r['token'];
						$fields['data'] = array('message' => "$message", 'title' => "$title");

						$headers = array('Authorization: key='.$api_access_key,'Content-Type: application/json');
						$ch = curl_init();
						curl_setopt( $ch,CURLOPT_URL, $api_access_url);
						curl_setopt( $ch,CURLOPT_POST, true );
						curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
						curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
						curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
						curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
						$result = curl_exec($ch);

						$qq = json_decode($result, true);

						if($qq['success'] == 1 ){
							$i++;
						}
					}

					curl_close( $ch );

					$qr1 = $db->prepare("INSERT INTO `nmba_inbox`(`title`,`message`,`date_time`)
							VALUES ('$title', '$message', UNIX_TIMESTAMP() )");
					$qr1->execute();

					$res['st'] = 1;
					
					if ($i == 1) {
						$mmsg = " Successfully notified $i user ";

					}else{
						$mmsg = " Successfully notified $i users ";
					}

					$res['msg'] = $mmsg;

				}else{
					$res['st'] = 3;
					$res['msg'] = 'Notification Error : No user Registerd';
				}

			}else{

				$res['st'] = 4;
				$res['msg'] = 'some field empty';
				
			}

			self::headers();
			echo json_encode($res);

		}


		///////Inbox List///////////////
		public static function inbox_list(){
			require_once realpath(__DIR__).'/../config/config.php';
			$json = json_decode(file_get_contents('php://input'),true);
			$db = conn();

			$arr = array();
			$qr = $db->prepare("SELECT title, message, date_time FROM nmba_inbox ORDER BY date_time DESC");
			$qr->execute();

			$qr1 = $db->prepare("DELETE FROM nmba_inbox WHERE date_time < UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL 10 DAY))");
			$qr1->execute();

			while ($r = $qr->fetch(PDO::FETCH_ASSOC)) {
				
				array_push($arr,array("title"=>ucfirst($r['title']), "message"=>$r['message'], "date_time"=>date('D, d M Y g:i a',$r['date_time'])));
			}

			if ($qr->rowCount() > 0) {
				$res['inbox_list'] = $arr;
				$res['st'] = 1;
				$res['msg'] = 'success';
			}else{
				$res['inbox_list'] = array();
				$res['st'] = 3;
				$res['msg']='No new message';
			}
					
			self::headers();
			echo json_encode($res);

		}


//////////////////////////////////////////////////////////
	} 
///////////////// END OF CLASS
	if (isset($_SERVER['HTTP_ORIGIN'])) {
		header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
		header('Access-Control-Allow-Credentials: true');
		header('Access-Control-Max-Age: 86400');
	}

	if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
		if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
			header("Access-Control-Allow-Methods: GET, POST ");         

		if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
			header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

		exit(0);
	}


	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$data = $_GET['call'];
		$obj = new v1();
		if (method_exists('v1', $data)) {
			$obj->$data();
		}else{
			$res = array('st' => 0, 'msg'=>'Invalid API call');
			echo json_encode($res);
		}

	}else{
		$res = array('st' => 0, 'msg'=>'Only POST METHOD ALLOWED');
		echo json_encode($res);
	}