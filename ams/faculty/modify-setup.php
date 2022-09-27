<!DOCTYPE html>
<html lang="en">

<head>
        <!-- including footer -->
        <?php
          include './common/header.php'
        ?>

        <!-- Page info -->
        <title>Faculty | Modify setup</title>

        <!-- css  -->
        <link rel="stylesheet" href="../css/faculty.css">
</head>

<body>
            <!-------------------------------------------------------Main Content------------------------------------------------------->
             <!--Subeject Setup Form Start-->
             <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12  grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Modify Setup</h4>
                                    <form class="forms-sample">
                                          
                                        <!--Semester & Subject-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group date">
                                                    <label>Semester</label>
                                                    <input type="number" class="form-control" id="sem"
                                                        name="semester">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 ">
                                                <label>Course</label>
                                                <select class="form-control">
                                                    <option>IT</option>
                                                    <option>ICT</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!--Course & Current Year-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group date">
                                                    <label>Current Year</label>
                                                    <input type="date" class="form-control" id="yearPicker"
                                                        name="yearpicker">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group col-md-6 ">
                                                <label>Subject</label>
                                                <select class="form-control">
                                                    <option>IOT</option>
                                                    <option>Web Development</option>
                                                    <option>RDBMS</option>
                                                    <option>Communication Skills</option>
                                                </select>
                                            </div>
                                        </div>

                                       
                                        <div class="row">
                                            <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary mr-2 mt-3">Create
                                            Setup</button>
                                        <button class="btn btn-light mt-3">Clear</button>
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-danger mr-5 mt-3">Delete Setup</button>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>


                        <!--Faculty Form End-->
                    </div>
                </div>




    <!-- including footer -->
    <?php
    include './common/footer.php'
    ?>
</body>

</html>