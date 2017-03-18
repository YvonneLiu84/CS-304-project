<html>

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
echo "Return the average salary of all internships <br/>";
$query= "select avg(salary) from industryjobsalary";
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


echo "Return the industry name, job title and salary with the ". $_POST["max/min"]." salary of all internships <br/>";
if(empty($_POST["max/min"])) {
    echo "";
}
elseif($_POST["max/min"]=="MAX") {
    $querymax = "select * from industryjobsalary where industryjobsalary.salary >= all 
             (select s2. salary from industryjobsalary s2)";
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
    $querymin="select * from industryjobsalary where industryjobsalary.salary <= all 
             (select s2. salary from industryjobsalary s2)";
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

</html>
