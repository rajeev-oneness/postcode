<?php 
	use App\User;
	use App\Model\Permission;
	use App\Model\GrantPermission;

	function randomGenerator()
	{
		return uniqid().''.date('ymdhis').''.uniqid();
	}
	function checkPermission()
	{
		$permissions = GrantPermission::where('user_id', auth()->id())->get();
		return $permissions;
	}
 ?>