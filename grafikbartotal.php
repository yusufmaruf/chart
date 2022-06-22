<?php
include('koneksi2.php'); // Akses ke database
// Mengambil data tb_country
$country = mysqli_query($koneksi,"SELECT * FROM tb_country");
while($row = mysqli_fetch_array($country)){
	$country_name[] = $row['country'];
	
	$query = mysqli_query($koneksi,"SELECT totalcases AS total FROM tb_covid WHERE id_country='".$row['id_country']."'");
	$row = $query->fetch_array();
	$total_cases[] = $row['total'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bar Chart</title>
	<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
	<div style="width: 800px;height: 800px">
		<canvas id="myChart"></canvas>
	</div>

	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: <?php echo json_encode($country_name); ?>,
				datasets: [{
					label: 'Grafik Total Cases COVID-19',
					data: <?php echo json_encode($total_cases); ?>,
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