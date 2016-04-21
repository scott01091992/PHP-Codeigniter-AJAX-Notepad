<?php
	foreach($notes as $note){
		echo "<div class='note'><span class='title'>{$note['title']}</span></h3><form class='delete' method='post'><input type='hidden' name='id' value='{$note['id']}'><button class='btn btn-default' type='submit'>Delete</button></form><form class='description_form' action='' method='post'><textarea colspan='5' name='description' class='description form-control'>{$note['description']}</textarea><input type='hidden' name='id' value='{$note['id']}'></form></div>";
	}
?>