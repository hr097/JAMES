<!DOCTYPE html>
<html lang="en">

<head>
          <!-- including footer -->
          <?php
          include './common/header.php'
        ?>

        <!-- Page info -->
        <title>AMS | Select class</title>

        <!-- css  -->
        <link rel="stylesheet" href="../css/faculty.css">
</head>

<body>
            <!-------------------------------------------------------Main Content------------------------------------------------------->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <!--Form Start-->
                        <div class="col-md-12  grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Take Attendance</h4>
                                    <form class="forms-sample">

                                        <!--Classroom no & Date-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Classroom Number</label>
                                                    <select class="form-control">
                                                        <option>Select Classroom</option>
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                        <option>6</option>
                                                        <option>7</option>
                                                        <option>8</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 ">
                                                <label>Date</label>
                                                <input type="date" class="form-control">
                                            </div>
                                        </div>
                                        <hr>
                                        <div style="font-size: 15px;font-weight:500; padding-bottom:17px;padding-top:10px;">Pick Time</div>
                                        <!--Time Picker-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                
                                                <div class="form-group">
                                                <label>From</label>
                                                <input type="time" class="form-control" id="appt" name="appt" 
                                                    required>
                                            </div>
                                            </div>
                                            <div class="form-group col-md-6 ">
                                                
                                                <div class="form-group">
                                                <label>To</label>
                                                <input type="time" class="form-control" id="appt" name="appt" 
                                                    required>
                                                </div>
                                            </div>
                                       </div>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary mr-2 mt-3" id="TakeattButton">Take Attendance</button>
                                                <button class="btn btn-light mt-3">Clear</button>
                                            </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--Form End-->
                    </div>
                </div>
            </div>
        </div>
</div>

    <script>
        $(document).ready(function () {
            $("#TakeattButton").click(function () {
                window.location.href = "./take_att.php";
            });
        });
    </script>

 <!-- including footer -->
 <?php
    include './common/footer.php'
    ?>
</body>

</html>