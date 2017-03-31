<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Finance Update</title>

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

            <div class="link-blue">

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

            <div class="link-red selected">

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
                        Finance team name: <input type = "text" name = "name" />
                        Finance team budget: <input type = "text" name = "budget" />
                        <input type = "submit" />
                    </form>


                    <?php
                    $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = dbhost.ugrad.cs.ubc.ca)(PORT = 1522)))(CONNECT_DATA=(SID=ug)))";
                    if ($c=OCILogon("ora_b0z8", "a31251135", $db)) {
                        echo "Successfully connected to Oracle.\n <br/>";
                    } else {
                        $err = OCIError();
                        echo "Oracle Connect Error " . $err['message'];
                    }
                    ##$parameter = $_SERVER['QUERY_STRING'];
                    echo "Update the total budget of a finance team (team name " .$_POST['name'].") to ". $_POST['budget']. "<br />";
                    if(empty($_POST['budget'])) {
                        echo "Please input one of finance team names: teamFA, teamFB, teamFC, teamFD, teamFE";
                    }
                    elseif($_POST['name']=="teamFA") {
                        $updateQuery = "UPDATE finance_team SET budget= " . $_POST['budget'] . " WHERE name='teamFA'";
                        $stid = oci_parse($c, $updateQuery);
                        $r = oci_execute($stid);
                        print '<table border="1">';
                        while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC)) {
                            print '<tr>';
                            foreach ($row as $item) {
                                print '<td>' . ($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp') . '</td>';
                            }
                            print '</tr>';
                        }
                        echo "Updated successfully";
                    }
                    elseif($_POST['name']=="teamFB") {
                        $updateQuery1 = "UPDATE finance_team SET budget= " . $_POST['budget'] . " WHERE name='teamFB'";
                        $stid1 = oci_parse($c, $updateQuery1);
                        $r1 = oci_execute($stid1);
                        print '<table border="1">';
                        while ($row1 = oci_fetch_array($stid1, OCI_RETURN_NULLS + OCI_ASSOC)) {
                            print '<tr>';
                            foreach ($row1 as $item1) {
                                print '<td>' . ($item1 !== null ? htmlentities($item1, ENT_QUOTES) : '&nbsp') . '</td>';
                            }
                            print '</tr>';
                        }
                        echo "Updated successfully";
                    }
                    elseif($_POST['name']=="teamFC") {
                        $updateQuery2 = "UPDATE finance_team SET budget= " . $_POST['budget'] . " WHERE name='teamFC'";
                        $stid2 = oci_parse($c, $updateQuery2);
                        $r2 = oci_execute($stid2);
                        print '<table border="1">';
                        while ($row2 = oci_fetch_array($stid2, OCI_RETURN_NULLS + OCI_ASSOC)) {
                            print '<tr>';
                            foreach ($row2 as $item2) {
                                print '<td>' . ($item2 !== null ? htmlentities($item2, ENT_QUOTES) : '&nbsp') . '</td>';
                            }
                            print '</tr>';
                        }
                        echo "Updated successfully";
                    }
                    elseif($_POST['name']=="teamFD") {
                        $updateQuery3 = "UPDATE finance_team SET budget= " . $_POST['budget'] . " WHERE name='teamFD'";
                        $stid3 = oci_parse($c, $updateQuery3);
                        $r3 = oci_execute($stid3);
                        print '<table border="1">';
                        while ($row3 = oci_fetch_array($stid3, OCI_RETURN_NULLS + OCI_ASSOC)) {
                            print '<tr>';
                            foreach ($row3 as $item3) {
                                print '<td>' . ($item3 !== null ? htmlentities($item3, ENT_QUOTES) : '&nbsp') . '</td>';
                            }
                            print '</tr>';
                        }
                        echo "Updated successfully";
                    }
                    else {
                        $updateQuery4 = "UPDATE finance_team SET budget= " . $_POST['budget'] . " WHERE name='teamFE'";
                        $stid4 = oci_parse($c, $updateQuery4);
                        $r4 = oci_execute($stid4);
                        print '<table border="1">';
                        while ($row4 = oci_fetch_array($stid4, OCI_RETURN_NULLS + OCI_ASSOC)) {
                            print '<tr>';
                            foreach ($row4 as $item4) {
                                print '<td>' . ($item4 !== null ? htmlentities($item4, ENT_QUOTES) : '&nbsp') . '</td>';
                            }
                            print '</tr>';
                        }
                        echo "Updated successfully";
                    }
                    print '</table>';
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
