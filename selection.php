<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Selection</title>

    <link rel="stylesheet" href="assets/sidebar-collapse.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css">
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
                        Year: <input type = "text" name = "year" />
                        <input type = "submit" />
                    </form>


                    <?php
                    $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = dbhost.ugrad.cs.ubc.ca)(PORT = 1522)))(CONNECT_DATA=(SID=ug)))";
                    if ($c=OCILogon("ora_b0z8", "a31251135", $db)) {
                        echo "Successfully connected to Oracle.\n";

                    } else {
                        $err = OCIError();
                        echo "Oracle Connect Error " . $err['message'];
                    }
                    ##$parameter = $_SERVER['QUERY_STRING'];
                    echo "Select all students with a year standing of " . $_POST["year"]. "<br />";
                    $query= "SELECT * FROM STUDENTS WHERE YEAR =". $_POST["year"];
                    $stid = oci_parse($c,$query);
                    $r = oci_execute($stid);
                    print '<table>';
                    while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
                        print '<tr>';
                        foreach ($row as $item) {
                            print '<td>'.($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp').'</td>';
                        }
                        print '</tr>';
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
