<?php defined('C5_EXECUTE') or die(_("Access Denied.")) ?>
<style type="text/css">
.address
{
	text-align:center;
	font-size:1.1em;
	font-weight:600;
	margin: 0 0 10px 0;
}
.btn-location-op4
{
	color: #00a2b1;
	background-color:  ;
	border-color:  ;
	font-size:14px;
	margin:0 0 0 -30px!important;
} 
i.location
{
	padding:0;
	margin: 0 10px 0 10px;
	font-size:25px;
}
</style>
<div class="col-md-6 col-md-offset-3 text-center">  
	<h2>
		<?php echo $hospitalName ?>
	</h2>
	<h3>
		<i class="fa location"> </i><?php echo $address ?></a> 
	</h3>
	<h3>
		<i class="fa" title="Phone"></i>Phone:&nbsp;<?php echo $phoneNumber; ?>
	</h3>
</div>