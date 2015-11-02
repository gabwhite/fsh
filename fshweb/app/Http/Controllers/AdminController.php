<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\UserProductImport;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Jobs\ParseProductImport;
use Storage;
use Ramsey\Uuid\Uuid;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function showImport()
    {
        return view('admin.import');
    }

    public function doImport(Request $request)
    {

        if($request->hasFile('importfile'))
        {
            $file = $request->file('importfile');

            if($file->isValid() && $file->getClientOriginalExtension() == 'csv')
            {
                // Save file to storage for processing

                $importInfo = array(
                    'user_id' => $request->user()->id,
                    'uuid' => Uuid::uuid4(),
                    'filename' => $file->getClientOriginalName(),
                    'include_headers' => true
                    );

                $file->move(storage_path('app/' . $importInfo['uuid']), $importInfo['filename']);

                $this->dispatch(new ParseProductImport($importInfo));
            }
        }

        echo "Done!";
    }

    public function showUsers()
    {
        $allUsers = \App\User::all();
        $allRoles = \App\Role::all();

        return view('admin.users', ['users' => $allUsers, 'roles' => $allRoles]);
    }

    public function viewUser($id)
    {
        $user = \App\User::find($id);
        $allRoles = \App\Role::all();

        return view('admin.userdetail')->with('user', $user)->with('roles', $allRoles);
    }

    public function editUser(Request $request)
    {
        $user = \App\User::find($request->input('userid'));

        $user->attachRole($request->input('role'));

        return redirect('admin/userview/' . $request->input('userid'));
    }

    public function showRoles()
    {
        $allRoles = \App\Role::all();
        $allPermissions = \App\Permission::all();

        return view('admin.roles', ['roles' => $allRoles, 'permissions' => $allPermissions]);
    }

    public function editRoles(Request $request)
    {
        $action = $request->input('action');
        if ($action == 'ADD')
        {
            $role = new \App\Role();
            $role->name = $request->input('rolename');
            $role->save();
        }
        elseif ($action == 'DELETE')
        {
            $roleId = $request->input('roleid');
            $role = \App\Role::findOrFail($roleId);

            $role->delete();
        }
        elseif ($action == "EDITPERMS")
        {
            $role = \App\Role::findOrFail($request->input('roleid'));
            $perms = $request->input('rolepermissions-' . $request->input('roleid'));

            $role->perms()->sync($perms);

        }

        return redirect('admin/roles');

    }

    public function showPermissions($id = null)
    {
        $allPermissions = \App\Permission::all();

        $p = null;
        if ($id != null)
        {
            $p = \App\Permission::find($id);
        }

        return view('admin.permissions', ['permissions' => $allPermissions, 'permission' => $p]);
    }

    public function editPermissions(Request $request)
    {
        $action = $request->input('action');
        if ($action == 'ADD') {

            $permission = new \App\Permission();

            if ($request->input('permissionid') != '')
            {
                $permission = \App\Permission::find($request->input('permissionid'));
            }

            $permission->name = $request->input('permissionname');
            $permission->display_name = $request->input('permissiondisplay');
            $permission->description  = $request->input('permissiondesc');
            $permission->save();

        }
        elseif ($action == 'DELETE')
        {
            $permissionId = $request->input('permissionid');
            $permission = \App\Permission::findOrFail($permissionId);

            $permission->delete();
        }

        return redirect('admin/permissions');

    }

}