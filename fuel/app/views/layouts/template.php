<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<title><?= ($title)? $title." | " : "" ; ?></title>
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
	<!-- <meta name="viewport" content="width=1024px" > -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="<?= $htmlmeta['description'] ?>">
    <meta name="keywords" content="<?= $htmlmeta['keywords'] ?>">
    <meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache"> 
	<link rel="apple-touch-icon" href="/webclip.png">
	<link rel="shortcut icon" href="/favicon.ico" />
	<?= Asset::css($css); ?>
	<?= Asset::js($js,array("charset"=>"UTF-8"))?>
	
	<script>
	</script>
</head>

<style type="text/css">
</style>

<body>
	<!-- HEADER -->
	<?= $header; ?>

	<!-- CONTENTS -->
	<?= $content; ?>

	<!-- FOOTER -->
	<?= $footer; ?>	
</body>

</html>
