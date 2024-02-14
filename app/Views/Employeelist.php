<?php 
include_once"header.php";
include_once"Sidebar.php";
?> 
<style>
  #logoimg
  {
    width: 100px;
  }

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Employee Data</h1>
        </div>
        <!-- /.col -->
        <!-- <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="#">Home</a>
            </li>
          </ol>
        </div> -->
      </div>
    </div>
  </div>
  <!-- /.content-header -->

<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Employee List</h3>
    </div>
    <div class="card-body">

<!-- ---------------------------------Employee data------------------------------>
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"> -->
  <table id="example1" class="table table-responsive-sm table-bordered">
    <thead>
      <tr>
        <th>S.No</th>
        <th>Company Name</th>
        <th>Designation</th>
        <th>Contact No.</th>
        <th>E-mail</th>
        <th>Image</th>
      </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        foreach($data as $row)
        {          
          echo "<tr>";
          echo "<td>".$i."</td>";
          echo "<td><b>".$row['employee_name']."</td>";
          echo "<td><b>".$row['designation']."</td>";
          echo "<td><b>".$row['contact_no']."</td>";
          echo "<td><b>".$row['email']."</td>";
        ?>
        <td><img style="width:100px"src="<?=base_url().'/public/usersignatures/'.$row['image'];?>"></td>
        <?php
          echo "</tr>";
          $i++;
          }
        ?>
      </tbody>
    </table>
  </div>
  </div>
<!----------------------- Card END------------------------->
</div>
<!-- -------------Content-wrapper ---------------------->
<?php include_once'Footer.php';?>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": false, "lengthChange": false, "autoWidth": true,
    })
  });
</script>
