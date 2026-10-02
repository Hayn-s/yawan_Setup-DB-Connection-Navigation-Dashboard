<?php
include "../check_login.php";
include "../db.php";

$booking_id = $_GET['booking_id'];

$get = mysqli_query($conn, "SELECT * FROM bookings WHERE booking_id = $booking_id");
$booking = mysqli_fetch_assoc($get);

$paidRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS s FROM payments WHERE booking_id = $booking_id"));
$total_paid = $paidRow['s'];

$balance = $booking['total_cost'] - $total_paid;

$toolsUsed = mysqli_query($conn, "SELECT bt.qty_used, bt.created_at, t.tool_name
  FROM booking_tools bt
  JOIN tools t ON bt.tool_id = t.tool_id
  WHERE bt.booking_id = $booking_id
  ORDER BY bt.booking_tool_id ASC");

if (isset($_POST['save'])) {
  $amount_paid = $_POST['amount_paid'];
  $method = $_POST['method'];

  mysqli_query($conn, "INSERT INTO payments (booking_id, amount_paid, method)
    VALUES ($booking_id, $amount_paid, '$method')");

  // recompute total paid and mark booking COMPLETE when fully paid
  $newPaid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS s FROM payments WHERE booking_id = $booking_id"));
  $new_balance = $booking['total_cost'] - $newPaid['s'];

  if ($new_balance <= 0) {
    mysqli_query($conn, "UPDATE bookings SET status='COMPLETE' WHERE booking_id=$booking_id");
  } else {
    mysqli_query($conn, "UPDATE bookings SET status='PENDING' WHERE booking_id=$booking_id");
  }

  header("Location: bookings_list.php");
  exit;
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Process Payment</title></head>
<body>

<h2>Process Payment (Booking #<?php echo $booking_id; ?>)</h2>

<p>Total Cost: ₱<?php echo number_format($booking['total_cost'],2); ?></p>
<p>Total Paid: ₱<?php echo number_format($total_paid,2); ?></p>

<p><b>Balance: ₱<?php echo number_format($balance,2); ?></b></p>

<h3>Tools Used</h3>
<?php if (mysqli_num_rows($toolsUsed) > 0) { ?>
  <table border="1" cellpadding="8">
    <tr>
      <th>Tool</th><th>Qty Used</th><th>Date</th>
    </tr>
    <?php while($tu = mysqli_fetch_assoc($toolsUsed)) { ?>
      <tr>
        <td><?php echo $tu['tool_name']; ?></td>
        <td><?php echo $tu['qty_used']; ?></td>
        <td><?php echo $tu['created_at']; ?></td>
      </tr>
    <?php } ?>
  </table>
<?php } else { ?>
  <p>No tools assigned to this booking.</p>
<?php } ?>

<br>

<form method="post">
  <label>Amount Paid</label><br>
  <input type="number" name="amount_paid" step="0.01" min="0"><br><br>

  <label>Method</label><br>
  <select name="method">
    <option value="CASH">CASH</option>
    <option value="GCASH">GCASH</option>
    <option value="BANK">BANK</option>
  </select><br><br>

  <button type="submit" name="save"
    style="background:#0d6efd; color:#fff; border:none; border-radius:6px; padding:8px 18px;">
    Save Payment
  </button>
</form>
</body>
</html>
