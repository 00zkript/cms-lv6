<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<style type="text/css" media="screen">
		.text-norawp{
			white-space: nowrap!important;
		}
		.text-muted{
			color: #6c757d!important;
		}
		.font-weight-bold {
		    font-weight: 700!important;
		}

		.table-responsive {
		    display: block;
		    width: 100%;
		    overflow-x: auto;
		    -webkit-overflow-scrolling: touch;
		    -ms-overflow-style: -ms-autohiding-scrollbar;
		}
		.text-justify {
		    text-align: justify!important;
		}



		table, td, th {
 		 border: 1px solid #ddd;
		}

		table {
		  border-collapse: collapse;
		  width: 100%;
		  border-radius: 5px;
		}

		th, td {
		  padding: 15px;
		}
		tbody>tr:hover {background-color: #f5f5f5;}


	</style>
</head>
<body>
	<table style="width: 100%" border="1" cellpadding="3" cellspacing="0">

		<tbody>
			<tr>
				<td>correo</td>
				<td>{{ $datos->email }}</td>
			</tr>
			<tr>
				<td>Asunto</td>
				<td>Deseo suscribirme</td>
			</tr>
		</tbody>
	</table>
</body>
</html>
