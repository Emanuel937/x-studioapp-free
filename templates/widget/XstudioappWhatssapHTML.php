
<?php

  $settings         = $this->get_settings_for_display();
  $whatssap_number  = $settings['whatsapp_number'];
  $whatssap_msg     = $settings['whatsapp_text'];



?>
<style>
  @import url("https://fonts.googleapis.com/css?family=Roboto:400,400i,700");
* {
	font-family: "Roboto", sans-serif;
}
button.xstudioapp_whatssap_button {
	outline: none;
	border: 0;
	background-color: #2ecc71;
	padding: 0;
	border-radius: 100%;
	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
	cursor: pointer;
	transition: opacity 0.3s, background 0.3s, box-shadow 0.3s;

}


.xstudioapp_whatssap_fixed {
	margin-right: 15px;
	margin-bottom: 15px;
}

.xstudioapp_whatssap_fixed > a {
	display: block;
	text-decoration: none;
}


.xstudioapp_whatssap_fixed > a:hover {
	opacity: 1;
	width: auto;
	padding-top: 7px;
	padding-left: 10px;
	padding-right: 10px;
	width: 100px;
}

/* animacion pulse */

.xstudioapp_whatssap_pulse {

	background: #10b418;
    position: relative;
	text-align: center;
	color: #ffffff;
	cursor: pointer;
	border-radius: 50%;

	display: inline-block;
	line-height: 65px;

	
}

.xstudioapp_whatssap_pulse:before {

	content: " ";
	position: absolute;
	background-color: #10b418;
	left: -20%;
	width: 150%;
	height: 150%;
	border-radius: 100%;
	animation-fill-mode: both;
	-webkit-animation-fill-mode: both;
	opacity: 0.6;
	-webkit-animation: pulse 1s ease-out;
	animation: pulse 1.8s ease-out;
		animation-iteration-count: 1;
	-webkit-animation-iteration-count: infinite;
	animation-iteration-count: infinite;
	top: -20%;
	
}


button.xstudioapp_whatssap_button img{
	width: 30px;
	height:30px

}

button.xstudioapp_whatssap_button{
	display: flex;
  justify-content: center;

  align-items: center;


}



@-webkit-keyframes pulse {
	0% {
		-webkit-transform: scale(0);
		opacity: 0;
	}
	25% {
		-webkit-transform: scale(0.3);
		opacity: 1;
	}
	50% {
		-webkit-transform: scale(0.6);
		opacity: 0.6;
	}
	75% {
		-webkit-transform: scale(0.9);
		opacity: 0.3;
	}
	100% {
		-webkit-transform: scale(1);
		opacity: 0;
	}
}

@keyframes pulse {
	0% {
		transform: scale(0);
		opacity: 0;
	}
	25% {
		transform: scale(0.3);
		opacity: 1;
	}
	50% {
		transform: scale(0.6);
		opacity: 0.6;
	}
	75% {
		transform: scale(0.9);
		opacity: 0.3;
	}
	100% {
		transform: scale(1);
		opacity: 0;
	}

	
	

}


</style>

<div class="xstudioapp_whatssap" onclick = redirection()>
	<div class="xstudioapp_whatssap_fixed xstudioapp_whatssap_pulse">
		
			<button class="xstudioapp_whatssap_button" >
				<img src="https://i.imgur.com/cAS6qqn.png" alt="x-studioapp whatssap">
			</button>
	
	
	</div>
</div>

<script>

     function 	redirection(){

		location.href = "https://api.whatsapp.com/send?phone=<?=$whatssap_number;?>&text=<?=$whatssap_msg?>";
	}
</script>