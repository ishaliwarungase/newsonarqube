<!DOCTYPE html>
<html>
<head>

	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css">

	<style>
	body{margin:2px;padding: 0;
		font-family: 'Quicksand',Helvetica,Arial,sans-serif;
		font-size: 14px;}
		#calendar {max-width: 100%;width: 100%;}

		.tooltip {
			position: relative;
			display: inline-block;
			border-bottom: 1px dotted black;
		}

		.tooltip .tooltiptext {

			width: 120px;
			bottom: 100%;
			left: 50%;
			margin-left: -60px;
			
			
			visibility: hidden;
			width: 120px;
			background-color: black;
			color: #fff;
			text-align: center;
			border-radius: 6px;
			padding: 5px 0;

			/* Position the tooltip */
			position: absolute;
			z-index: 1;
		}

		.tooltip:hover .tooltiptext {
			visibility: visible;
		}
	</style>


</head>

<body>
	<?php
	require_once realpath(__DIR__).'/../config/config.php';
	$db = conn();
	$qr = $db->prepare("SELECT id , title, from_date_time, to_date_time, event_type FROM nmba_event");
	$qr->execute();

	if ($qr->rowCount() > 0) {	
		$res = $qr->fetchAll(PDO::FETCH_ASSOC);
		$arr = array();

		foreach ($res AS $r) {

			array_push($arr, array("title" => $r['title'] , "start" => date('Y-m-d', $r['from_date_time'] ), "end" => date('Y-m-d', strtotime('+1 day', $r['to_date_time']) ), "BackgroundColor" =>"#03A9F4" ) );
		}

		$fp = fopen('events.json', 'w');
		fwrite($fp, json_encode($arr));
		fclose($fp);

	}else{
		$res = 'NO EVENT TO DISPLAY';
	}
	
	?>

	<div id='calendar'></div>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: ''
				},
				editable: false,
				height: 500,
				eventLimit: true,
				events: '<?php echo $url['_base']; ?>views/events.json',
				eventColor: '#448AFF'

			});
		});
	</script>

</body>
</html>