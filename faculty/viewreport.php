<?php

require_once("../ams.php");
$JAMES = new AMS("User");
$JAMES->init_user_session();

if (!($JAMES->checkSession()&&$_SESSION["_userType"]==="2")) {
    $JAMES->ams_redirect("../login.php");
}

$cc="";
$student_list="";
$total_count = 3;
$header_main = "";

function getHeader($cc)
{
    $sql = "select * from Ams_setup_students_map where ams_setup_id=$cc limit 1;";
    $result = mysqli_query($GLOBALS['JAMES']->connection(), $sql);

    
    $header_list = "
    <th>Roll Number</th>
    <th>SPID</th>
    <th>Full Name</th>
    ";

    if (mysqli_num_rows($result)==1) {

        $student = mysqli_fetch_assoc($result);

        $spid = $student['spid']; 

        $sql = "select DATE_FORMAT(DATE(AAM.att_date_time),'%d/%m/%Y') As att_date from Ams_attendance_master AAM where ams_setup_id=$cc and spid='$spid';";
        $result = mysqli_query($GLOBALS['JAMES']->connection(), $sql);

        if (mysqli_num_rows($result)>=1) {

            while ($record = mysqli_fetch_assoc($result)) 
            {   
                $header_list.=
                "
                <th>".$record['att_date']."</th>
                ";
                $GLOBALS['total_count'] =  $GLOBALS['total_count'] + 1;
            }
        }
    }
    return $header_list;

}

function getRecords($rn,$spid,$name)
{
    
    
    $row_header_list = "
    <tr>
    <td>".$rn."</td>
    <td>".$spid."</td>
    <td>".$name."</td>
    ";

    $class_code = $GLOBALS['cc'];

    //@query
    $sql = "select att_status from Ams_attendance_master where ams_setup_id=$class_code and spid=$spid;";
    $result = mysqli_query($GLOBALS['JAMES']->connection(), $sql);
    
    if (mysqli_num_rows($result)>=1) {

        while($record = mysqli_fetch_assoc($result)) 
        {   

            if($record['att_status']==1)
            {
                $row_header_list.=
                "
                <td>Present</td>
                ";
            }
            else if($record['att_status']==0)
            {
                $row_header_list.=
                "
                <td>Absent</td>
                ";
            }
            else
            {
                $row_header_list.=
                "
                <td>-</td>
                ";
            }
          
          
        }
    }
    else
    {   
        while($i<=$GLOBALS['total_count'])
        {   
            
            $row_header_list.=
            "
            <td>-</td>
            ";
            $i++;
        }
        
    }
    
           
   return $row_header_list."</tr>";

}

if(isset($_GET["classid"]))
{
        //to fetch students who have enrolled in particular classroom
        $cc=$_GET["classid"];

        $header_main = getHeader($cc);

        if($GLOBALS['total_count'] !=3 )
        {

            //@query
            $sql = "select Students.spid,cur_roll_no,name from Ams_setup_students_map,Students where Students.spid=Ams_setup_students_map.spid and ams_setup_id=$cc;";
            $result = mysqli_query($GLOBALS['JAMES']->connection(), $sql);
        
            if (mysqli_num_rows($result)>=1) {

                while ($record = mysqli_fetch_assoc($result)) 
                {   
                    $student_list.= getRecords($record['cur_roll_no'],$record['spid'],$record['name']);
                }
            }

        }
        else
        {
            $student_list.="<tr><td  colspan='3' style='font-size:1.2em;text-align:center;'>No Student Attendance Found Yet!</td></tr>";
        }

}
else
{
    $JAMES->ams_redirect("../login.php");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/b-print-2.3.3/datatables.min.css"/>
 

    <!-- including footer -->
    <?php
        include './common/header.php'
    ?>

    

    <!-- Page info -->
    <title>AMS | Classroom</title>

    <!-- css  -->
    <link rel="stylesheet" href="../css/faculty.css">
    
    <!-- js  -->
   
    <script src="../js/faculty/viewreport.js" type="text/javascript" defer=true></script>

</head>

<body>
    <!-------------------------------------------------------Main Content------------------------------------------------------->
    <div class="main-panel">
        <div class="content-wrapper">


            <div class="row">

            <button type='button' onclick="window.location.href='./dashboard.php'"
                        style="verticle-align:middle;padding:9px;width:90px;height:40px;float:left;position:relative;bottom:10px;display:inline;border-radius:12px;"
                        class='btn form-control btn-primary btn-icon-text'>

                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                        </svg>
                        Back
            </button>

                <!-------------------------------------------------------Table Start------------------------------------------------------->
                <div class="col-lg-12 grid-margin">



                    

                    <div class="card mt-4">
                        <div class="card-body">
                            <h4 class="card-title">Students Attendance<span style='float:right;font-weight:500;'><?php echo "Class Code: ".$cc;?></span></h4>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="order-listing-export" class="table">
                                            <thead>
                                                <tr>
                                                    <?php echo $header_main?>
                                                </tr>
                                            </thead>
                                            <tbody id="enrolledstudentlist">
                                                <?php
                                                echo $student_list;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            
            <div style="display:inline-block;" id="report_export">

            </div>
               <!--Table End-->

        </div>                    
      </div>
    </div>
 </div>

    <!-- including footer -->
    <?php
    include './common/footer.php'
    ?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/b-print-2.3.3/datatables.min.js"></script>

<script>
    <?php
    
    if($student_list != "<tr><td  colspan='7' style='font-size:1.2em;text-align:center;'>No Student Enrollment Yet!</td></tr>")
    {
        echo <<<EOL
    var table = $('#order-listing-export').DataTable({
        "aLengthMenu": [
          [5, 10, 15, -1],
          [5, 10, 15, "All"]
        ],
        "iDisplayLength": -1,
        "language": {
          search: ""
        },
        buttons:[{ 
              extend: 'excel', 
              title: '',
              text: ' <i class="ti-import btn-icon-prepend" style="padding-right:10px"></i> Download Full Report',
              exportOptions: {
                      columns: [ 0, 1, 2, 3, 4, 5]
              },
              filename: 'AMS_Report_$cc'
              
          }]
      });
      table.buttons().container().appendTo('#report_export');
      $('#order-listing-export').each(function() {
        var datatable = $(this);
        // SEARCH - Add the placeholder for Search and Turn this into in-line form control
        var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
        search_input.attr('placeholder', 'Search');
        search_input.removeClass('form-control-sm');
        // LENGTH - Inline-Form control
        var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
        length_sel.removeClass('form-control-sm');
    });
    EOL;
    }
    
    ?>
    
</script>


</body>

</html>