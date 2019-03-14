<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo isset($title) ? $title : ""; ?></title>
    <link rel="stylesheet" type="text/css" href="./assets/jquery.dataTables.min.css">
    <link rel="stylesheet" href="./assets/bootstrap3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
    <link href="./assets/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/chart.css">
    <script src="./assets/pace.js"></script>
    <link rel="stylesheet" href="./assets/pace.css">

    <script>
        function isNumberKey(evt){
					var charCode = (evt.which) ? evt.which : event.keyCode
					console.log(charCode);
					if ((charCode <= 57 && charCode >= 48) || charCode == 46)
						return true;
					return false;
				}
    </script>
    <?php
        function rupiah($angka){
	
            $hasil_rupiah = number_format($angka,0,'','.');
            return $hasil_rupiah;
         
        }
    ?>
</head>