<?php include_once"header.php";
include_once'Sidebar.php';
?>
<style>
.fa-trash {
    color: orange;
    font-size: larger;
}

.fa-edit {
    color: steelblue;
    font-size: larger;
}

#logoimg {
    width: 100px;
    height: 80px;
}

#alerttxt1 {
    font-weight: bold;
    font-size: larger;
    color: orange;
    margin: auto;
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Company Data</h1>
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
                <h3 class="card-title">Company List</h3>
            </div>
            <div class="card-body">
                <!-- -----------------------NEW Company-------------------------------------->
                <div class="row">
                    <div class="col-sm-6">
                        <a href="<?=base_url('admin/addcompany').''?>" class="btn btn-success">
                            <span>+Add Company</span>
                        </a>
                    </div>
                    <div class="col-sm-12 text-center">
                        <span id="alerttxt1"><?=session()->get("response");?></span>
                    </div>
                </div>
                <!-- ---------------------NEW Comapany-END------------------------------------>
                <table id="example1" class="table table-responsive-md table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Company Name</th>
                            <th>Logo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          $i=1;
                          foreach($data as $row)
                          {          
                            echo "<tr>";
                            echo "<td>".$i."</td>";
                            echo "<td><b>".$row['company_name']."</b></td>";
                          ?>
                        <td class="text-center"><img src="<?=base_url().'/public/images/'.$row['logo']?>" class="img-fluid" id="logoimg"></td>
                        <td class="text-center" id="actionbtn">
                            <a class="px-2 btn btn-lg" href="<?=base_url('admin/edit/'.$row['id']);?>"><i class="fas fa-edit"></i></a>
                            <a class="px-2 btn btn-lg" href="<?=base_url('admin/delete/'.$row['id']);?>" onclick="return confirm('Are you sure you want to delete this ?')"><i class="fas fa-trash"></i></a>
                        </td>
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
</div>
<!-- -------------Content-wrapper ---------------------->
<?php include_once'Footer.php';?>
<script>
$(function() {
    $("#example1").DataTable({
        "responsive": false,
        "lengthChange": false,
        "autoWidth": false,
    })
});

// script for timeout of alert message
var timeout = 3000; // in miliseconds (3*1000)
$('#alerttxt1').delay(timeout).fadeOut(300);
</script>