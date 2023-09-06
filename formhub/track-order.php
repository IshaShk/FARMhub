<?php
session_start();
include_once 'includes/config.php';

$oid = isset($_GET['oid']) ? intval($_GET['oid']) : null;

if ($oid !== null) {
    $ret = mysqli_query($con, "SELECT * FROM ordertrackhistory WHERE orderId='$oid'");
    $num = mysqli_num_rows($ret);

    $st = 'Delivered';
    $rt = mysqli_query($con, "SELECT * FROM orders WHERE id='$oid'");
    while ($num = mysqli_fetch_array($rt)) {
        $currentSt = $num['orderStatus'];
    }
}
?>

<script language="javascript" type="text/javascript">
function f2() {
    window.close();
}

function f3() {
    window.print();
}
</script>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Order Tracking Details</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="anuj.css" rel="stylesheet" type="text/css">
</head>
<body>

<div style="margin-left:50px;">
    <form name="updateticket" id="updateticket" method="post">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr height="50">
                <td colspan="2" class="fontkink2" style="padding-left:0px;">
                    <div class="fontpink2"><b>Order Tracking Details !</b></div>
                </td>
            </tr>
            <tr height="30">
                <td class="fontkink1"><b>Order Id:</b></td>
                <td class="fontkink"><?php echo $oid; ?></td>
            </tr>

            <?php
            if ($oid !== null) {
                if ($num > 0) {
                    while ($row = mysqli_fetch_array($ret)) {
                        ?>
                        <tr height="20">
                            <td class="fontkink1"><b>At Date:</b></td>
                            <td class="fontkink"><?php echo $row['postingDate']; ?></td>
                        </tr>
                        <tr height="20">
                            <td class="fontkink1"><b>Status:</b></td>
                            <td class="fontkink"><?php echo $row['status']; ?></td>
                        </tr>
                        <tr height="20">
                            <td class="fontkink1"><b>Remark:</b></td>
                            <td class="fontkink"><?php echo $row['remark']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><hr /></td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="2">Order Not Processed Yet</td>
                    </tr>
                <?php
                }

                if ($st == $currentSt) {
                    ?>
                    <tr>
                        <td colspan="2"><b>Product Delivered successfully</b></td>
                    </tr>
                <?php
                }
            } else {
                echo "<tr><td colspan='2'>Order ID is missing.</td></tr>";
            }
            ?>
        </table>
    </form>
</div>

</body>
</html>


     