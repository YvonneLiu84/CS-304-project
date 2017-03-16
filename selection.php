<html>

<form action = "<?php $_PHP_SELF ?>" method = "POST">
    Year: <input type = "text" name = "year" />
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
echo "Select all students with a year standing of " . $_POST["year"]. "<br />";
$query= "SELECT * FROM STUDENTS WHERE YEAR =". $_POST["year"];
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


OCILogoff($c);
?>
</html>
