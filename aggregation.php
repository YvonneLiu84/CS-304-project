<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Aggregation</title>

    <link rel="stylesheet" href="assets/demo.css">
    <link rel="stylesheet" href="assets/sidebar-collapse.css">

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>

</head>
<body>
<div>

    <!-- Sidebar -->
    <aside class="sidebar-left-collapse">

        <a href="index.php" class="company-logo">Internship</a>

        <div class="sidebar-links">

            <div class="link-blue selected">

                <a href="#">
                    <i class="fa fa-male"></i>Admin Team
                </a>

                <ul class="sub-links">
                    <li><a href="update.php">Update</a></li>
                    <li><a href="selection.php">Selection</a></li>
                    <li><a href="join.php">Join</a></li>
                    <li><a href="division.php">Division</a></li>
                    <li><a href="aggregation.php">Aggregation</a></li>
                    <li><a href="nested aggregation.php">Nested Aggregation</a></li>
                    <li><a href="delete.php">Delete</a></li>
                </ul>

            </div>

            <div class="link-red">

                <a href="#">
                    <i class="fa fa-money"></i>Finance Team
                </a>

                <ul class="sub-links">
                    <li><a href="finance_update.php">Update</a></li>
                    <li><a href="finance_selection.php">Selection</a></li>
                </ul>

            </div>





        </div>

    </aside>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div class = "main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <form action = "<?php $_PHP_SELF ?>" method = "POST">
                        Max or Min or Average  ?: <input type = "text" name = "max/min/average" />
                        Count : <input type = "text" name = "count" />
                        <input type = "submit" />
                    </form>

                    <?php
                    /**
                     * Created by PhpStorm.
                     * User: Estelle
                     * Date: 2017-03-24
                     * Time: 12:16 PM
                     */

                    $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = dbhost.ugrad.cs.ubc.ca)(PORT = 1522)))(CONNECT_DATA=(SID=ug)))";
                    if ($c=OCILogon("ora_b0z8", "a31251135", $db)) {
                        echo "Successfully connected to Oracle.\n <br/>";
                    } else {
                        $err = OCIError();
                        echo "Oracle Connect Error " . $err['message'];
                    }

                    echo "Get the " . $_POST["max/min/average/"] . "salary among all the internships ". "or the number 
of internships <br/>";

                    if(empty($_POST["max/min/average"] OR $_POST["count"])) {
                        echo "";
                    } elseif ($_POST["max/min/average"]!="MAX" AND $_POST["max/min/average"]!="MIN" AND $_POST["max/min/average"]!="AVERAGE" AND ($_POST["count"]) != "YES") {
                        echo "Please input a valid value, such as MAX, MIN, AVERAGE and YES for count";

                     }elseif ($_POST["max/min/average"]=="MAX"){
                        $sql1 = "select max(salary) as maxSalary
                 from industryjobsalary";
                        $stid1 = oci_parse($c, $sql1);
                        $r1 = oci_execute($stid1);
                        print '<table border="1">';
                        while ($rowmax = oci_fetch_array($stid1, OCI_RETURN_NULLS + OCI_ASSOC)) {
                            print '<tr>';
                            foreach ($rowmax as $itemmax) {
                                print '<td>' . ($itemmax !== null ? htmlentities($itemmax, ENT_QUOTES) : '&nbsp') . '</td>';
                            }
                            print '</tr>';
                        }
                        print '</table>';
                    } elseif($_POST["max/min/average"]=="MIN") {
                        $sql2 = "select min(salary) as minSalary
                 from industryjobsalary";
                        $stid2 = oci_parse($c, $sql2);
                        $r2 = oci_execute($stid2);
                        print '<table border="1">';
                        while ($rowmin = oci_fetch_array($stid2, OCI_RETURN_NULLS + OCI_ASSOC)) {
                            print '<tr>';
                            foreach ($rowmin as $itemmin) {
                                print '<td>' . ($itemmin !== null ? htmlentities($itemmin, ENT_QUOTES) : '&nbsp') . '</td>';
                            }
                            print '</tr>';
                        }
                        print '</table>';
                    } elseif($_POST["max/min/average"]=="AVERAGE") {
                        $sql3 = "select avg(salary) as avgSalary from industryjobsalary";
                        $stid3 = oci_parse($c, $sql3);
                        $r3 = oci_execute($stid3);
                        print '<table border="1">';
                        while ($rowav = oci_fetch_array($stid3, OCI_RETURN_NULLS + OCI_ASSOC)) {
                            print '<tr>';
                            foreach ($rowav as $itemav) {
                                print '<td>' . ($itemav !== null ? htmlentities($itemav, ENT_QUOTES) : '&nbsp') . '</td>';
                            }
                            print '</tr>';
                        }
                        print '</table>';
                    } elseif (($_POST["count"])== "YES"){
                        $sql4 = "SELECT COUNT(*) FROM internship";
                        $stid4 = oci_parse($c, $sql4);
                        $r4 = oci_execute($stid4);
                        print '<table border="1">';
                        while ($rowav = oci_fetch_array($stid4, OCI_RETURN_NULLS + OCI_ASSOC)) {
                            print '<tr>';
                            foreach ($rowav as $itemav) {
                                print '<td>' . ($itemav !== null ? htmlentities($itemav, ENT_QUOTES) : '&nbsp') . '</td>';
                            }
                            print '</tr>';
                        }
                        print '</table>';
                    }
                    else {
                        echo "Your input is invalid";
                    }
                    OCILogoff($c);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Menu collapse Script -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

    $(function () {

        var links = $('.sidebar-links > div');

        links.on('click', function () {

            links.removeClass('selected');
            $(this).addClass('selected');

        });
    });

</script>




</body>
</html>
