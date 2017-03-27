<html>
<form action = "<?php $_PHP_SELF ?>" method = "POST">
    jobtitle: <input type = "text" name = "sid" />
    <input type = "submit" />
</form>

<?php
/**
 * Created by PhpStorm.
 * User: Estelle
 * Date: 2017-03-24
 * Time: 11:25 AM
 */
$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = dbhost.ugrad.cs.ubc.ca)(PORT = 1522)))(CONNECT_DATA=(SID=ug)))";
if ($c=OCILogon("ora_s5p0b", "a34843145", $db)) {
    echo "Successfully connected to Oracle.\n <br/>";
} else {
    $err = OCIError();
    echo "Oracle Connect Error " . $err['message'];
}

echo "Get basic information of students and their internship whose student ID is " . $_POST["sid"] . "<br/>";

$sql = "SELECT s.sid, s.name, i.jobtitle FROM students s INNER JOIN internship i ON s.sid = i.sid  WHERE s.sid =" . $_POST["sid"];
$stid1 = oci_parse($c, $sql);
$r1 = oci_execute($stid1);
//for execute
print '<table border="1">';
while ($row = oci_fetch_array($stid1, OCI_RETURN_NULLS + OCI_ASSOC)) {
    print '<tr>';
    foreach ($row as $item) {
        print '<td>' . ($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp') . '</td>';
    }
    print '</tr>';
}

print '</table>';
OCILogoff($c);

?>

</html>


