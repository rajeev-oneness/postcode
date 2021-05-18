<?php

namespace App\Http\Controllers\Moderator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Permission;
use App\Model\GrantPermission;
use Hash;

class ModeratorController extends Controller
{
    public function manage()
    {
        $users = User::where('userType', 4)->get();
        return view('portal.moderator.index', compact('users'));
    }
    public function create()
    {
        return view('portal.moderator.add');
    }
    public function store(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password'=> 'required|min:8|confirmed',
            'password_confirmation' => 'required|min:8'

        ]);
        $moderator = new User;
        $moderator->name = $req->name;
        $moderator->email = $req->email;
        $moderator->password = Hash::make($req->password);
        $moderator->userType = 4;
        $moderator->save();
        
        $permissions = Permission::all();
        foreach($permissions as $permission){
            $GrantPermission = new GrantPermission;
            $GrantPermission->user_id = $moderator->id;
            $GrantPermission->permission_id = $permission->id;
            $GrantPermission->add = 0;
            $GrantPermission->edit = 0;
            $GrantPermission->delete = 0;
            $GrantPermission->save();
        }
        return redirect()->route('admin.moderator.manage');
    }
    public function edit($moderatorId)
    {
        $moderator = User::find(decrypt($moderatorId));
        return view('portal.moderator.edit', compact('moderator'));
    }
    public function update(Request $req)
    {
        $req->validate([
            'name' => 'required'
        ]);
        $moderator = User::find($req->moderatorId);
        $moderator->name = $req->name;
        $moderator->save();
        return redirect()->route('admin.moderator.manage');
    }
    public function delete($moderatorId)
    {
        $moderator = User::find(decrypt($moderatorId));
        $moderator->delete();
        return redirect()->route('admin.moderator.manage');
    }
    public function managePermissions($userId)
    {
        $permissions = GrantPermission::where('user_id', decrypt($userId))->with('permission_details')->get();
        return view('portal.moderator.permission.index', compact('permissions', 'userId'));
    }
    public function grantManagePermissions(Request $req)
    {
        foreach($req->permissionId as $key => $id){
            $GrantPermission = GrantPermission::find($id);
            $add = $GrantPermission->permission_id.'_add';
            $edit = $GrantPermission->permission_id.'_edit';
            $delete = $GrantPermission->permission_id.'_delete';
            $GrantPermission->user_id = decrypt($req->userId);
            $GrantPermission->permission_id = $GrantPermission->permission_id;
            $GrantPermission->add = $req->$add[0];
            $GrantPermission->edit = $req->$edit[0];
            $GrantPermission->delete = $req->$delete[0];
            $GrantPermission->save();
        }
        return redirect()->route('admin.moderator.manage');
    }
}
