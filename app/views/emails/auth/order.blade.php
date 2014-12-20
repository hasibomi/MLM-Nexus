<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Order received</h2>

		<div>
			We received your order. You ordered us the following(s)-
			
			<ul>
				@foreach ($query as $row)
					<li>{{ $row->product->first()->name }} - {{ $row->product->first()->price }}</li>
				@endforeach
			</ul>

			<p>Please pay at your nearest bank.</p>

			<h3>Our Bank Account</h3>
			<p>Anonymous bank</p>
			<p><strong>Account no:</strong> 141 546 87316</p>
			<p><strong>Amount: </strong> $500</p>

			<h3>Thank you.</h3>
		</div>
	</body>
</html>
