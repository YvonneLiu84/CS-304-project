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
                    Start Bootstrap
                </a>
            </li>
            <li>
                <a href="update.php">Selection</a>
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

<form action = "<?php $_PHP_SELF ?>" method = "POST">
    Max or Min ?: <input type = "text" name = "max/min" />
    <input type = "submit" />
</form>


<?php
$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = dbhost.ugrad.cs.ubc.ca)(PORT = 1522)))(CONNECT_DATA=(SID=ug)))";
if ($c=OCILogon("ora_j2z9a", "a39864146", $db)) {
    echo "Successfully connected to Oracle.\n";

} else {
    $err = OCIError();
    echo "Oracle Connect Error " . $err['message'];
}
##$parameter = $_SERVER['QUERY_STRING'];
echo "Return the average salary of internships grouped by job titles<br/>";
$query= "select jobtitle, avg(salary) from industryjobsalary group by jobtitle";
$stid = oci_parse($c,$query);
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


echo "Return the ". $_POST["max/min"]." salary of internships grouped by job titles<br/>";
if(empty($_POST["max/min"])) {
    echo "";
}
elseif($_POST["max/min"]=="MAX") {
    $querymax = "select max(x.avg)
                 from (select avg(salary) as avg from industryjobsalary 
                 group by jobtitle) x";
    $stidmax = oci_parse($c, $querymax);
    $rmax = oci_execute($stidmax);
    print '<table border="1">';
    while ($rowmax = oci_fetch_array($stidmax, OCI_RETURN_NULLS + OCI_ASSOC)) {
        print '<tr>';
        foreach ($rowmax as $itemmax) {
            print '<td>' . ($itemmax !== null ? htmlentities($itemmax, ENT_QUOTES) : '&nbsp') . '</td>';
        }
        print '</tr>';
    }
    print '</table>';
}
elseif($_POST["max/min"]=="MIN")  {
    $querymin="select min(x.avg)
               from (select avg(salary) as avg from industryjobsalary 
               group by jobtitle) x";
    $stidmin = oci_parse($c,$querymin);
    $rmin = oci_execute($stidmin);
    print '<table border="1">';
    while ($rowmin = oci_fetch_array($stidmin, OCI_RETURN_NULLS+OCI_ASSOC)) {
        print '<tr>';
        foreach ($rowmin as $itemmin) {
            print '<td>'.($itemmin !== null ? htmlentities($itemmin, ENT_QUOTES) : '&nbsp').'</td>';
        }
        print '</tr>';
    }
    print '</table>';
}
else {
    echo "Your input is invalid. Please input MAX or MIN";
}

OCILogoff($c);
?>

        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>


</html>
