<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
</head>
<body>
	<div>
		<a href='<?php echo site_url('cocktail/cocktail_managment')?>'>Cocktails</a> |
		<a href='<?php echo site_url('cocktail/bar_managment')?>'>Bars</a> |
		<a href='<?php echo site_url('cocktail/last_call_reminder_managment')?>'>Last Call Reminder</a> |
		<a href='<?php echo site_url('cocktail/happy_hour_managment')?>'>Happy Hours</a> | 
		<a href='<?php echo site_url('cocktail/events_managment')?>'>Events</a> |		 
		<a href='<?php echo site_url('cocktail/special_offer_managment')?>'>Special Offers</a> |
		<a href='<?php echo site_url('cocktail/groupon_managment')?>'>Groupon</a>
		
	</div>
	<div style='height:20px;'></div>  
    <div style="padding: 10px;">
		<?php echo $output; ?>
    </div>
    <?php foreach($js_files as $file): ?>
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>
</body>
</html>
