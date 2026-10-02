<?php
include "../check_login.php";
include "../db.php";

$sql = "
SELECT p.*, b.total_cost
FROM payments p
JOIN bookings b ON p.booking_id = b.booking_id
ORDER BY p.payment_id DESC
";
$result = mysqli_query($conn, $sql);
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Payments</title></head>
<body>
<?php include "../nav.php"; ?>

<h2>Payments</h2>

<table border="1" cellpadding="8">
  <tr>
    <th>ID</th><th>Booking</th><th>Amount Paid</th><th>Method</th><th>Date</th>
  </tr> 
  <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?php echo $row['payment_id']; ?></td>
      <td>#<?php echo $row['booking_id']; ?></td>
      <td>₱<?php echo number_format($row['amount_paid'],2); ?></td>
      <td><?php echo $row['method']; ?></td>
      <td><?php echo $row['payment_date']; ?></td>
    </tr>
  <?php } ?>
</table>
</body>
</html>
