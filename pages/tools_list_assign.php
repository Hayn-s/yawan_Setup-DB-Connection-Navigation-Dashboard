<?php
include "../check_login.php";
include "../db.php";

$message = "";

$tools = mysqli_query($conn, "SELECT * FROM tools ORDER BY tool_name ASC");

if (isset($_POST['assign'])) {
  $booking_id = $_POST['booking_id'];
  $tool_id = $_POST['tool_id'];
  $qty_used = $_POST['qty_used'];

  mysqli_query($conn, "INSERT INTO booking_tools (booking_id, tool_id, qty_used)
    VALUES ($booking_id, $tool_id, $qty_used)");

  mysqli_query($conn, "UPDATE tools
    SET quantity_available = quantity_available - $qty_used
    WHERE tool_id=$tool_id");

  $message = "Tool assigned to Booking #$booking_id.";
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Tools / Inventory</title></head>
<body>
<?php include "../nav.php"; ?>

<h2>Tools / Inventory</h2>

<h3>Available Tools</h3>
<table border="1" cellpadding="8">
  <tr>
    <th>Name</th><th>Total</th><th>Available</th>
  </tr>
  <?php while($t = mysqli_fetch_assoc($tools)) { ?>
    <tr>
      <td><?php echo $t['tool_name']; ?></td>
      <td><?php echo $t['quantity_total']; ?></td>
      <td><?php echo $t['quantity_available']; ?></td>
    </tr>
  <?php } ?>
</table>

<hr>

<h3>Assign Tool to Booking</h3>
<p style="color:red;"><?php echo $message; ?></p>

<form method="post">
  <label>Booking ID</label><br>
  <select name="booking_id">
    <?php
      $bookings = mysqli_query($conn, "SELECT booking_id FROM bookings ORDER BY booking_id ASC");
      while($b = mysqli_fetch_assoc($bookings)) {
    ?>
      <option value="<?php echo $b['booking_id']; ?>">#<?php echo $b['booking_id']; ?></option>
    <?php } ?>
  </select><br><br>

  <label>Tool</label><br>
  <select name="tool_id">
    <?php
      $toolOptions = mysqli_query($conn, "SELECT * FROM tools ORDER BY tool_name ASC");
      while($t = mysqli_fetch_assoc($toolOptions)) {
    ?>
      <option value="<?php echo $t['tool_id']; ?>">
        <?php echo $t['tool_name']; ?> (Avail: <?php echo $t['quantity_available']; ?>)
      </option>
    <?php } ?>
  </select><br><br>

  <label>Qty Used</label><br>
  <input type="number" name="qty_used" min="1" value="1"><br><br>

  <button type="submit" name="assign"
    style="background:#0d6efd; color:#fff; border:none; border-radius:6px; padding:8px 18px;">
    Assign
  </button>
</form>
</body>
</html>
