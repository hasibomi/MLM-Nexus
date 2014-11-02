$(document).ready(function() {
	/**
	 * Arrange member to left hand side 
	 */
	$(".glyphicon-hand-left").click(function() {
		var id = $(this).attr('id');
		
		// Ajax request
		$.ajax({
			url: '/user/accountleft',
			type: 'post',
			dataType: 'HTML',
			data: 'id=' + id + '&left=' + 'Left',
			success: function(data) {
				alert(data);
				location.href = '/user/account';
			}
		});
	});
	
	/**
	 * Arrange member to right hand side 
	 */
	$(".glyphicon-hand-right").click(function() {
		var id = $(this).attr('id');
		
		// Ajax request
		$.ajax({
			url: 'accountright',
			type: 'POST',
			dataType: 'HTML',
			data: 'id=' + id + '&right=' + 'Right' + 'token' + 'input[name=_token]',
			success: function(data) {
				alert(data);
				location.href = '/user/account';
			}
		});
	});
});
