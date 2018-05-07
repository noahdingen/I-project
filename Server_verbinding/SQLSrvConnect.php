<?php
$dsn = "sqlsrv:Server=mssql.iproject39.icasites.nl,1433;Database=EenmaalAndermaal";
try
{
    $conn = new PDO($dsn, "iproject39", "Mj9cP5NoYv");
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    $sql = "SELECT tst_Column1, tst_Column2, tst_Column3 FROM test";

    foreach ($conn->query($sql) as $row)
    {
        print_r($row);
    }
    echo ('Done');
}
catch(PDOException $e)
{
    echo $e->getMessage();
}
?>
