<html>

<form action = "<?php $_PHP_SELF ?>" method = "POST">
    Student ID: <input type = "text" name = "sid" />
    Year: <input type = "text" name = "year" />
    <input type = "submit" />
</form>


<?php
$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = dbhost.ugrad.cs.ubc.ca)(PORT = 1522)))(CONNECT_DATA=(SID=ug)))";
if ($c=OCILogon("ora_j2z9a", "a39864146", $db)) {
    echo "Successfully connected to Oracle.\n <br/>";

} else {
    $err = OCIError();
    echo "Oracle Connect Error " . $err['message'];
}
##$parameter = $_SERVER['QUERY_STRING'];
echo "Update the year standing of student (student ID " .$_POST['sid'].") to ". $_POST['year']. "<br />";
if(empty($_POST['year'])) {
    echo "";
}
else {
    $updateQuery = "UPDATE STUDENTS SET YEAR= " . $_POST['year'] . " WHERE SID=" . $_POST['sid'];
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
print '</table>';

OCILogoff($c);
?>
</html>
