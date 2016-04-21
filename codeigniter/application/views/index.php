<!DOCTYPE HTML>
<html>
	<head>
		<title> Notepad</title>
		<link rel='stylesheet' type='text/css' href='/assets/bootstrap.min.css'>
		<script type="text/javascript" src='/assets/jquery-2.2.0.min.js'></script>
		<script type="text/javascript">
			//get html from notes in db
			$(document).ready(function(){
				$.get('/notepad/notes_html', function(res) {
         			$('#note_box').html(res);
        		});
        		
        		//add a new note to db and update notes on screen
        		$(document).on('submit','#note_form', function(){
        			$.post('/notepad/create',$(this).serialize(), function(res){
        				$('#note_box').html(res);	
        			});
        			$("#title").val('');
        			return false;
        		});

        		//delete note from db and update on screen
        		$(document).on('submit', '.delete',function(){
        			$.post("/notepad/delete", $(this).serialize(), function(res){
        				$('#note_box').html(res);
        			});
        			return false;
        		});

        		//determine which textarea is focused, countdown and reset timer on every keystroke from user waiting for them to finish typing
				$(document).on('focus', '.description_form', function(){ 
					var current_box = $(this);
				    var typingTimer;      
					var doneTypingInterval = 2500;  
					$(this).keyup(function(){
						console.log('start');
					    clearTimeout(typingTimer);
					    if ($(this).val) {
					       typingTimer = setTimeout(doneTyping, doneTypingInterval);
					    }
					});

					//user finished typing, execute doneTyping function to update db
					function doneTyping () {
						$(document).on('submit', '.description_form', function(){
					   			$.post("/notepad/update_description", $(this).serialize(), function(res){
					   				$("#updated").html("Last Saved at: "+res);
					   			});
					   			
					   			return false;
					   	});
					   	current_box.submit();
					};
					   
				});
				
			});

		</script>
		<style>
			.delete{
				float: right;
				margin-right: 10px;
				margin-bottom: 10px;
			}
			.note{
				border: 1px solid black;
				padding: 10px;
				margin: 10px;
				display: inline-block;
				border-radius: 5px;
			}
			.title{
				text-transform: capitalize;
				color: purple;
				font-weight: bold;
				margin-right: 10px;
			}
			#updated{
				font-size: 14px;
				color: green;
				margin-left: 10px;
			}
			
		</style>
	</head>
	<body>
		<div class='container'>
			<div class='row'>
				<div class='col-xs-12'>
					<h1>My Notes:<span id='updated'></span></h1>
					<div id='note_box'>
					</div>
					<form id='note_form' action='' method='post' role='form'>
						<div class='form-group'>
							<input id='title' class='form-control' type='text' name='title' placeholder="Insert note title here">
						</div>
						<button type='submit' id='add_note' class='btn btn-default'>Add Note</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
