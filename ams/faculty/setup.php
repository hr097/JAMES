<!DOCTYPE html>
<html lang="en">

<head>
        <!-- including footer -->
        <?php
          include './common/header.php'
        ?>

        <!-- Page info -->
        <title>AMS | Subject setup</title>

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
                                    <h4 class="card-title">Create Setup</h4>
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
                                        <!--FID and Setup Type-->
                                        <!-- <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>FID</label>
                                                    <input type="number" class="form-control" id="fid"
                                                        placeholder="Enter Faculty ID">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="form-group">
                                                    <label>AMS Setup ID</label>
                                                    <input type="number" class="form-control" id="setupid"
                                                        placeholder="Enter Setup ID">
                                                </div>
                                            </div>
                                        </div> -->

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

                                      


                                        <!--Post-->

                                        <!-- <div class="form-group">
                                            <label>Post</label>
                                            <select class="form-control">
                                                <option>Professor</option>
                                                <option>Visiting Faculty</option>
                                                <option>Assistant Faculty</option>
                                            </select>
                                        </div> -->

                                        <!--Profile Image-->
                                        <!-- <div class="form-group">
                                            <label>Profile Picture</label>
                                            <input type="file" name="img[]" class="file-upload-default">
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control file-upload-info" disabled
                                                    placeholder="Upload Profile Image">
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-primary"
                                                        type="button">Upload</button>
                                                </span>
                                            </div>
                                        </div> -->

                                        <button type="submit" class="btn btn-primary mr-2 mt-3">Create
                                            Setup</button>
                                        <button class="btn btn-light mt-3">Clear</button>
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