<?php
include('koneksi2.php'); // Akses ke database
//kasus terbaru
$country = mysqli_query($koneksi,"SELECT * FROM tb_country");
while($row = mysqli_fetch_array($country)){
	$country_name[] = $row['country'];
	// Mengambil data newcases pada tb_covid19 
	$query = mysqli_query($koneksi,"SELECT newcases FROM tb_covid19 WHERE id_country='".$row['id_country']."'");
	$row = $query->fetch_array();
	$active_cases[] = $row['newcases'];
}
?>
<?php
// kematian terbaru 
$country = mysqli_query($koneksi,"SELECT * FROM tb_country");
while($row = mysqli_fetch_array($country)){
	// Mengambil data total deaths pada tb_covid19 
	$query = mysqli_query($koneksi,"SELECT newdeaths FROM tb_covid19 WHERE id_country='".$row['id_country']."'");
	$row = $query->fetch_array();
	$newdeaths[] = $row['newdeaths'];
}
// penyembuhan terbaru
$country = mysqli_query($koneksi,"SELECT * FROM tb_country");
while($row = mysqli_fetch_array($country)){
	// Mengambil data total recovered pada tb_covid19 
	$query = mysqli_query($koneksi,"SELECT newrecovered FROM tb_covid19 WHERE id_country='".$row['id_country']."'");
	$row = $query->fetch_array();
	$recovered[] = $row['newrecovered'];
}
// total kematian 
$country = mysqli_query($koneksi,"SELECT * FROM tb_country");
while($row = mysqli_fetch_array($country)){	
	// Mengambil data total deaths pada tb_covid19 
	$query = mysqli_query($koneksi,"SELECT totaldeaths FROM tb_covid19 WHERE id_country='".$row['id_country']."'");
	$row = $query->fetch_array();
	$totaldeaths[] = $row['totaldeaths'];
}
// total rekoveri
$country = mysqli_query($koneksi,"SELECT * FROM tb_country");
while($row = mysqli_fetch_array($country)){
	// Mengambil data total recovered pada tb_covid19 
	$query = mysqli_query($koneksi,"SELECT totalrecovered FROM tb_covid19 WHERE id_country='".$row['id_country']."'");
	$row = $query->fetch_array();
	$totalrecovered[] = $row['totalrecovered'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Line Chart</title>
	<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
	<div style="width: 800px;height: 800px">
		<canvas id="myChart"></canvas>
		<canvas id="myChart2"></canvas>
		<canvas id="myChart3"></canvas>
		<canvas id="myChart4"></canvas>
		<canvas id="myChart5"></canvas>
	</div>

	<script>

		// kasus terbaru 
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: <?php echo json_encode($country_name); ?>,
				datasets: [{
					label: 'Grafik Kasus terbaru COVID-19',
					data: <?php echo json_encode($active_cases); ?>,
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
					borderColor: 'rgba(255,99,132,1)',
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});

		// kematian terbaru grafik 
		var ctx2 = document.getElementById("myChart2").getContext('2d');
		var myChart2 = new Chart(ctx2, {
			type: 'line',
			data: {
				labels: <?php echo json_encode($country_name); ?>,
				datasets: [{
					label: 'Grafik kematian terbaru  COVID-19',
					data: <?php echo json_encode($newdeaths); ?>,
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
					borderColor: 'rgba(255,99,132,1)',
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});

		// penyembuhan terbaru grafik 
		var ctx3 = document.getElementById("myChart3").getContext('2d');
		var myChart = new Chart(ctx3, {
			type: 'line',
			data: {
				labels: <?php echo json_encode($country_name); ?>,
				datasets: [{
					label: 'Grafik penyembuhan terbaru COVID-19',
					data: <?php echo json_encode($recovered); ?>,
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
					borderColor: 'rgba(255,99,132,1)',
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
		
		// total kematian 
		var ctx4 = document.getElementById("myChart4").getContext('2d');
		var myChart = new Chart(ctx4, {
			type: 'line',
			data: {
				labels: <?php echo json_encode($country_name); ?>,
				datasets: [{
					label: 'Grafik total deaths COVID-19',
					data: <?php echo json_encode($totaldeaths); ?>,
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
					borderColor: 'rgba(255,99,132,1)',
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});

		// total rekoveri 
		var ctx5 = document.getElementById("myChart5").getContext('2d');
		var myChart = new Chart(ctx5, {
			type: 'line',
			data: {
				labels: <?php echo json_encode($country_name); ?>,
				datasets: [{
					label: 'Grafik total Recovared COVID-19',
					data: <?php echo json_encode($totalrecovered); ?>,
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
					borderColor: 'rgba(255,99,132,1)',
					borderWidth: 1
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});


	</script>
</body>
</html>

