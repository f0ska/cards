<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Card Management Application</title>
    <link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/css/custom.css')?>" rel="stylesheet" type="text/css" />
</head>

<body>
    
    <div class="container js_content">
        <?=$this->tpl->get('content')?>
    </div>

    <script src="<?=base_url('assets/js/jquery-2.1.4.min.js')?>"></script>
    <script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('assets/js/bootstrap-datepicker.min.js')?>"></script>
    <script src="<?=base_url('assets/js/custom.js')?>"></script>
</body>
</html>