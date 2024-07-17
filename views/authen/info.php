<h1 class="tieude">
<?php 
  $last_three_digits = substr($_SESSION['user']['phone'], -3);
  $formatNumber  = "0******".$last_three_digits;
  echo $formatNumber;
?>

</h1>
<?php 
list($username, $domain) = explode('@', $_SESSION['user']['email']);

// Lấy số ký tự của phần username (trừ 2 ký tự đầu và 1 ký tự sau)
$visible_chars = strlen($username) - 3;

// Định dạng lại phần username
$formatted_username = substr($username, 0, 2) . str_repeat('*', $visible_chars) . substr($username, -1);

// Kết hợp lại và hiển thị địa chỉ email đã định dạng
$formatted_email = $formatted_username . '@' . $domain;
echo  $formatted_email; ?>