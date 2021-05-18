<?php 
	use App\User;
	use App\Model\Permission;
	use App\Model\GrantPermission;

	function randomGenerator()
	{
		return uniqid().''.date('ymdhis').''.uniqid();
	}
	
 ?>