<?php 
include_once"header.php";
include_once"Sidebar.php";
?> 
<!-- ---------------------------------main body content--------------------------------------- -->
	<div class="content-wrapper">
	    <!-- Content Header (Page header) -->
	    <div class="content-header">
	      <div class="container-fluid">
	        <div class="row mb-2">
	          <div class="col-sm-6">
	            <h1 class="m-0">Add New Company Data</h1>
	          </div><!-- /.col -->
	          <div class="col-sm-6">
	            <ol class="breadcrumb float-sm-right">
	              <li class="breadcrumb-item"><a href="#">Home</a></li>
	            </ol>
	          </div>
	        </div>
	      </div>
	    </div>
	    <!-- /.content-header -->
	<div class="container-fluid m-0">
				<div class="card card-primary">
	              <div class="card-header">
	              </div>
	              <!-- /.card-header -->
	              <div class="card-body">
	                <form method="post" action="<?=base_url('admin/insert');?>" enctype="multipart/form-data">
	                  <div class="row">

	                    <div class="col-sm-6">
	                      <div class="form-group">
	                        <label>Company Name</label>
	                        <input type="text" class="form-control" placeholder="Enter Company Name" name="companyname" required>
	                      </div>
	                    </div>

	                    <div class="col-sm-6">
	                    	<div class="form-group">
	                        	<label>Company Website</label>
	                        	<input class="form-control" placeholder="Enter website as https://example.com" type="url" pattern="http(s?)(:\/\/)((www.)?)(([^.]+)\.)?([a-zA-z0-9\-_]+)(.com|.net|.gov|.org|.in)(\/[^\s]*)?" size="30" required name="companysite">
	                        </div>
	                    </div>

	                  </div>

	                  <div class="row">

	                    <div class="col-sm-6">
	                      <div class="form-group">
	                        <label>Speciality</label>
	                        <input class="form-control" name="speciality" placeholder="Enter Speciality" required>
	                      </div>
	                    </div>

	                    <div class="col-sm-6">
	                    	<div class="form-group">
	                    		<label>Select Logo</label>
				            	<input class="form-control p-1" type="file" name="file" multiple="true" placeholder="Select Logo" required>
	                    	</div>
	                    </div>

	                  </div>

	                  <div class="row">

	                    <div class="col-sm-6">
	                      <div class="form-group">
	                        <label>Content</label>
	                        <textarea class="form-control" rows="5" placeholder="Enter Content" name="content" value="" required></textarea>
	                      </div>
	                    </div>
	                  </div>

	                  <div class="row">
	                  	<button class="btn btn-primary" name="Submit">Submit</button>
	                  </div>

	                </form>
	              </div>
	              <!-- /.card-body -->
	            </div>
	        </div>
	</div>
	  <!-- /.content-wrapper -->
<?php include_once"Footer.php";?>