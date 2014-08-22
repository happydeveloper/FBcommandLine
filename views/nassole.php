<?php
	require_once 'classes/nassolefordev.php';

	$nassole = new Nassolefordev();
	$nassole->getStream();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>좋아요 리스트 </title>
</head>
<body>
	<p> 해당건에 대한 좋아요한 사람</p>
	<a href="https://www.facebook.com/permalink.php?story_fbid=937615956253427&id=929225043759185">페이스북 원본 글</a>
	<ul>
		<?php
		foreach($nassole->result as $row) {
			if(is_array($row)) {
				foreach($row as $key => $value) {
					if($key == 'data')
						if(is_array($value)){
						foreach($value as $key1=>$values1)
								echo "<li><a href='".isset($values1["link"])."'>".$values1["name"]."</a></li>";
					}
				}
			}	
}
		?>
	</ul>	
	<?php
	?>
</body>
</html>
