<?php
if(isset($notification))
{
	$type = $notification['type'];
	$message = $notification['message'];
	if($type == "error")
	{
		?>
		<div class="notification notification_error"><?php echo $message?></div>
		<?php
	}
	elseif($type == "success")
	{
		?>
		<div class="notification notification_success"><?php echo $message?></div>
		<?php
	}
}
?>