<?PHP
// Original PHP code by Chirp Internet: www.chirp.com.au
// Please acknowledge use of this code by including this header.
ob_start();
session_start();
if ($_SESSION['admin'] && intval($_SESSION['admin']) === 1) {
    require_once '../includes/connect.php';
    function cleanData(&$str)
    {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }

// filename for download
    $flag = false;
    $query = $con->prepare("SELECT `name`, `email`, `mobile`, `national_id`, `university`, `a_status`, `ieee_member`, `code` FROM registeration") or die('Query failed!');
    $query->execute(array());
    if ($query->rowCount() > 0) {
        $eventName = "Mega Brain To Be '18";
        $filename = $eventName . "_" . date('Ymd') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            if (!$flag) {
                // display field/column names as first row
                echo implode("\t", preg_replace('/(ieee_member)/', 'membership', array_keys($row))) . "\r\n";
                $flag = true;
            }
            array_walk($row, __NAMESPACE__ . '\cleanData');
            echo implode("\t", array_values($row)) . "\r\n";
        }
    } else {
        header('Location: ../index.php');
    }
    exit();
} else {
    header("Location:../index.php");
    exit();
}
?>