<html>
<head>
	<title>Simulação</title>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<style type="text/css">
		.container {
			width: 100vw;
			height: 80vh;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			line-height: 0px;
		}
		.titulo{
			color: white;	 
		}
	</style>
</head>
<body>
	<div class="fixed-action-btn">
  		<a class="btn-floating btn-large red">
    		<i class="large material-icons">mode_edit</i>
  		</a>
  		
  		<ul>
		    <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
		    <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
		    <li><a class="btn-floating green">asasas<i class="material-icons">publish</i></a></li>
		    <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
  		</ul>
	</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.fixed-action-btn');
    var instances = M.FloatingActionButton.init(elems, {
      direction: 'left'
    });
  });
</script>
</html>