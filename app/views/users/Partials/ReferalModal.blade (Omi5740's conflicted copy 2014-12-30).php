<div class="modal fade" id="referalModal" tabindex="-1" role="dialog" arie-labelledby="referalModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" data-dismiss="modal" type="button">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				
				<h4 class="modal-title" id="referalModalLabel">Refere a friend</h4>
			</div>
			
			<div class="modal-body">
				{{ Form::open(["url" => "refer"]) }}
					{{ Form::email("email", "", ["placeholder" => "Your friend's email", "class" => "form-control"]) }}
					<br />
					{{ Form::textarea("referMessage", "Hi, I am " . $profile->name . ". You can earn money from this website " . url("login"), ["class" => "form-control", "placeholder" => "Enter your message here..."]) }}
					{{ Form::submit("Send", ["class" => "btn btn-block btn-success"]) }}
				{{ Form::close() }}
			</div>
		</div>
	</div>
</div>