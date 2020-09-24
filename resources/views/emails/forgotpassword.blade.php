<html>
	<head>
		<title>Email De Perdida De Contraseña</title>
	</head>
	<body>




			<table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;">
			<tr><td>Frutexco</td></tr>
	<tr>
		<td style="background-color: #ecf0f1; text-align: left; padding: 0">
			<a href="">
			<img src="{{ $message->embed(public_path().'/images/frontend_images/home/FRUTEXCO.png') }}">
			</a>
		</td>
	</tr>

	<tr>
		<td style="background-color: #ecf0f1">
			<div style="color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif">
				<h2 style="color: #e67e22; margin: 0 0 7px">Hola Querid@ {{ $name }}!!</h2>
				<p style="margin: 2px; font-size: 15px">
				    Tu cuenta ha sido actualizada exitosamente.<br>
					La inmformacion de su cuenta es la siguiente con una nueva contraseña:<br>
					Correo: {{ $email }}!<br>
					Gracias Y Saludos.<br></p>
					<br>
					<br>

				<div style="width: 100%; text-align: center">
					<a style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #3498db" href="" >Nueva contraseña: {{ $password }}</a>
				</div>
				<p style="color: #b3b3b3; font-size: 12px; text-align: center;margin: 30px 0 0">Frutexco 2020</p>
			</div>
		</td>
	</tr>
</table>


	</body>
</html>
