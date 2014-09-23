<?php
function human_time_string($time)
{
	$time = time() - $time; // to get the time since that moment

	$tokens = array (
		31536000 => 'year',
		2592000 => 'month',
		604800 => 'week',
		86400 => 'day',
		3600 => 'hour',
		60 => 'minute',
		1 => 'second'
	);

	foreach ($tokens as $unit => $text)
	{
		if ($time < $unit) continue;
		$numberOfUnits = floor($time / $unit);
		return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
	}

	return "";
}


function time_elapsed_string($datetime, $full = false)
{
	$now = new DateTime();
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = array('y' => 'year',
		'm' => 'month',
		'w' => 'week',
		'd' => 'day',
		'h' => 'hour',
		'i' => 'minute',
		's' => 'second',);
	foreach ($string as $k => &$v)
	{
		if ($diff->$k)
		{
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		}
		else
		{
			unset($string[$k]);
		}
	}

	if (!$full)
	{
		$string = array_slice($string, 0, 1);
	}
	return $string ? implode(', ', $string) : 'just now';
}

function graph($id, $value, $data)
{
	$dataString = "";
	foreach ($data as $data_item)
	{
		$dataString = $dataString . "data.addRow(['$data_item[name]', $data_item[value], 'opacity: 0.8', '$data_item[service] ($data_item[value])']);\n";
	}

	return "<script type='text/javascript' src='https://www.google.com/jsapi'></script>
<script type='text/javascript'>
	google.load('visualization', '1', {packages:['corechart']});
	google.setOnLoadCallback(drawChart);
	function drawChart() {
		var data = new google.visualization.DataTable();
		data.addColumn('string', 'Service');
		data.addColumn('number', '$value');
		data.addColumn({type:'string', role:'style'});
		data.addColumn({type:'string', role:'annotation'});
		$dataString

		var options = {
			legend: 'none'
			//title: 'Visits'
		};
		var chart = new google.visualization.BarChart(document.getElementById('$id'));
		chart.draw(data, options);
	}
	</script><div id='$id' style='width: 800px;'></div>";
}
?>