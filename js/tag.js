
        function reloadDiv(path) {
            var path = path;
			$.ajax({
				url : 'main.php?path='+ path,
				dataType : 'html'
			})
			.done(function(data){
				$('#gallery').html(data);
			});
        }