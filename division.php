<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Sidebar - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div id="wrapper" class = "toggled">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a href="hello.php">
                    Internship Database
                </a>
            </li>
            <li>
                <a href="update.php">Update</a>
            </li>
            <li>
                <a href="selection.php">Selection</a>
            </li>
            <li>
                <a href="division.php">Division</a>
            </li>
            <li>
                <a href="aggregation.php">Aggregation</a>
            </li>

        </ul>
    </div>
    <!-- /#sidebar-wrapper -->
    <div id="page-content-wrapper">
        <div class="container-fluid">

            <?php
            $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = dbhost.ugrad.cs.ubc.ca)(PORT = 1522)))(CONNECT_DATA=(SID=ug)))";
            if ($c=OCILogon("ora_j2z9a", "a39864146", $db)) {
                echo "Successfully connected to Oracle.\n <br/>";

            } else {
                $err = OCIError();
                echo "Oracle Connect Error " . $err['message'];
            }
            ##$parameter = $_SERVER['QUERY_STRING'];
            echo "Return the advisor ID and name who is assigned to all students <br />";
            $divisionQuery = "select a. aid, a.name from advisor_work a
                  where not exists(
                  select * from students
                  where not exists(
                  select * from student_assign
                  where student_assign.aid=a.aid and student_assign.sid=students.sid))";
            $stid = oci_parse($c,$divisionQuery);
            $r = oci_execute($stid);
            print '<table border="1">';
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
    <!-- /#page-content-wrapper -->

</div>


</html>
