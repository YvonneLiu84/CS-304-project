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
if ($c=OCILogon("ora_s5p0b", "a34843145", $db)) {
    echo "Successfully connected to Oracle.\n <br/>";
} else {
    $err = OCIError();
    echo "Oracle Connect Error " . $err['message'];
}

echo "Get the " . $_POST["max/min/average/"] . "salary among all the internships ". "or " . $_POST["count"] . " the number 
of internships <br/>";

if(empty($_POST["max/min/average"] OR $_POST["count"])) {
    echo "";
} elseif ($_POST["max/min/average"]=="MAX"){
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
} elseif (($_POST["count"])== "COUNT"){
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