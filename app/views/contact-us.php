<?php include 'includes/header.php'; ?>
<!-- Header -->
	 <div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12">    			   			
					<h2 class="title text-center">Get In Touch</strong></h2>
				</div>			 		
			</div>    	
    		<div class="row">
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
				            <div class="form-group col-md-6">
				                <input type="text" name="name" class="form-control" required="required" placeholder="Name">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" class="form-control" required="required" placeholder="Email">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control" required="required" placeholder="Subject">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
				            </div>
				        </form>
	    			</div> <!--/.contact-form-->
	    		</div> <!--/.col-sm-8-->
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center">Contact Info</h2>
	    				<address>
	    					<p>Nexus IT Zone</p>
							<p>House: 1(3rd floor), Road: 4, Block: A, Section: 10</p>
							<p>Mirpur, Dhaka-1216</p>
							<p>Mobile: +880 1615 888920</p>
							<p>Mobile: +880 1615 888921</p>
							<p>Email: info@nexusitzone.com</p>
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center">Social Networking</h2>
							<ul>
								<li>
									<a href="http://www.facebook.com/NexusITzone"><i class="fa fa-facebook"></i></a>
								</li>
							</ul>
	    				</div>
	    			</div>
    			</div> <!-- /.col-sm-4 -->
	    	</div> <!-- /.row -->
    	</div>	<!-- /.bg -->
    </div><!--/#contact-page.container-->
	
	<!-- Footer -->
	<?php include 'includes/footer.php';?>
</body>
</html>