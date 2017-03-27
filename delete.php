<html>

<form action = "<?php $_PHP_SELF ?>" method = "POST">
    Student ID: <input type = "text" name = "sid" />
    <input type = "submit" />
</form>

<?php
/**
 * Created by PhpStorm.
 * User: Estelle
 * Date: 2017-03-23
 * Time: 12:00 PM
 */


$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = dbhost.ugrad.cs.ubc.ca)(PORT = 1522)))(CONNECT_DATA=(SID=ug)))";
if ($c=OCILogon("ora_s5p0b", "a34843145", $db)) {
    echo "Successfully connected to Oracle.\n";
} else {
    $err = OCIError();
    echo "Oracle Connect Error " . $err['message'];
}

//echo "Delete the students (student ID" . $_POST['sid'].  ") whose major is" . $_POST['major']. "<br />";
echo "Delete the students whose student ID is " . $_POST['sid'].  "<br />";

    $sql1 = "DELETE FROM students WHERE sid = " . $_POST['sid'];
    $stid1 = oci_parse($c, $sql1);
    $r1 = oci_execute($stid1);
    //for execute
    print '<table border="1">';
    while ($row = oci_fetch_array($stid1, OCI_RETURN_NULLS + OCI_ASSOC)) {
        print '<tr>';
        foreach ($row1 as $item1) {
            print '<td>' . ($item1 !== null ? htmlentities($item1, ENT_QUOTES) : '&nbsp') . '</td>';
        }
        print '</tr>';
    }

    echo "Delete successfully";

print '</table>';

$sql2 = "SELECT * FROM students";
$stid2 = oci_parse($c, $sql2);
$r2 = oci_execute($stid2);
//for execute
print '<table border="1">';
while ($row2 = oci_fetch_array($stid2, OCI_RETURN_NULLS + OCI_ASSOC)) {
    print '<tr>';
    foreach ($row2 as $item2) {
        print '<td>' . ($item2 !== null ? htmlentities($item2, ENT_QUOTES) : '&nbsp') . '</td>';
    }
    print '</tr>';
}


print '</table>';
OCILogoff($c);

?>
</html>
