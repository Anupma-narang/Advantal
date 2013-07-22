<!--
   mail.html
   
   Copyright 2012 José Luis <calambrenet@codefriends.es>
   
   This program is free software; you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation; either version 2 of the License, or
   (at your option) any later version.
   
   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.
   
   You should have received a copy of the GNU General Public License
   along with this program; if not, write to the Free Software
   Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
   MA 02110-1301, USA.
   
   
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>sin título</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 0.21" />
	<style type="text/css">
		a{
			color: #006600;
			font-weight: bold;
		}
		a:visited{
			color: #009900;
		}
		body {
			font-family:"Trebuchet MS","Lucida Sans Unicode", "Lucida Grande", Verdana;
			font-size: 15px;
			margin-top: 0px;
		}		
		.nosotros_auditoscopia {
			color: #b41b1d;
			font-weight: bold;   
		}
		.auditoscopia_o {
			color: #343434;
			color: #000; font-weight: bold;
		}		
	</style>
</head>

<body>
	<p>Hola <span style="font-weight:bold; color:#999999;"><?php echo $alias?></span>:</p>
	<p>En <span class="nosotros_auditoscopia">audit<span class="auditoscopia_o">o</span>scopia</span> hemos recibido una <strong>solicitud de alta de colaborador por tu parte</strong>, utilizando este correo electrónico.</p>
	<p>Por favor, <strong>confirma que este correo electrónico es tuyo</strong> haciendo clic <?php echo link_to("aquí", "sfApply/confirm?validate=$validate", array("absolute" => true))?>.</p>
	<p>Si no te funciona, copia y pega la siguiente dirección en tu navegador: <?php echo url_for("sfApply/confirm?validate=$validate", true)?> </p>
	<br/>
	<p>Muchas gracias por tu colaboración y confianza.</p>
	
</body>

</html>