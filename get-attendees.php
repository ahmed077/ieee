<?PHP
// Original PHP code by Chirp Internet: www.chirp.com.au
// Please acknowledge use of this code by including this header.
ob_start();
session_start();
if ($_SESSION['admin'] && intval($_SESSION['admin']) === 1 && isset($_GET['id'])) {
    require_once 'includes/connect.php';
    $id = $_GET['id'];
    function cleanData(&$str)
    {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }

// filename for download
    $flag = false;
    $query = $con->prepare("SELECT `name`,`faculty`,`semester`,`email`,`facebook_profile`,`mobile`,`membership_type` FROM attendees WHERE event_id = ?") or die('Query failed!');
    $query->execute(array($id));
    if ($query->rowCount() > 0) {
        $query2 = $con->prepare("SELECT title FROM events WHERE id=?");
        $query2->execute(array($id));
        $eventName = $query2->fetch(PDO::FETCH_ASSOC)['title'];
        $filename = $eventName . "_" . date('Ymd') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row) {
            $row['membership_type'] = intval($row['membership_type']) === 1 ? "Yes" : "No";
            if (!$flag) {
                // display field/column names as first row
                echo implode("\t", preg_replace('/(membership_type)/', 'membership', array_keys($row))) . "\r\n";
                $flag = true;
            }
            array_walk($row, __NAMESPACE__ . '\cleanData');
            echo implode("\t", array_values($row)) . "\r\n";
        }
    } else {
        header('Location: index.php');
    }
    exit();
} else {
    header("Location:index.php");
    exit();
}
?>