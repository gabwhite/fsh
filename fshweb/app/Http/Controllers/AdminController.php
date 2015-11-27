<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\RebuildSearchIndex;
use App\ProductImportOptions;
use App\UploadHandler;
use App\UserProductImport;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Jobs\ParseProductImport;
use Storage;
use Ramsey\Uuid\Uuid;

use App\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function showImport()
    {
        // Get all vendors in the system

        $users = Role::find(2)->users()->get();

        return view('admin.import')->with('vendors', $users);
    }

    public function doImport(Request $request)
    {
        if($request->hasFile('importfile'))
        {
            $filename = $request->file('importfile')->getClientOriginalName();
            $directory = Uuid::uuid4()->toString();

            $uploader = new UploadHandler();
            $result = $uploader->uploadCsv($request->file('importfile'), $directory, $filename);

            if($result)
            {

                $importInfo = new ProductImportOptions();
                $importInfo->setUserId($request->input('vendor'));
                $importInfo->setUuid($directory);
                $importInfo->setFileName($filename);
                $importInfo->setIncludeHeaders($request->input('includesheaders') ? true : false);
                $importInfo->setAddAsActive($request->input('addasactive') ? true : false);
                $importInfo->setIgnoreExisting($request->input('ignoreexisting') ? true : false);
                $importInfo->setSimulate($request->input('simulate') ? true : false);

                /*
                $importInfo = array(
                    'user_id' => $request->user()->id,
                    'uuid' => $directory,
                    'filename' => $filename,
                    'include_headers' => $request->input('includesheaders') ? true : false,
                    'add_as_active' => $request->input('addasactive') ? true : false,
                    'ignore_existing' => $request->input('ignoreexisting') ? true : false,
                    'simulate' => $request->input('simulate') ? true : false
                    );
                */

                $this->dispatch(new ParseProductImport($importInfo));
            }
        }

        echo "Done!";
    }

    public function showUsers()
    {
        //$allUsers = \App\Models\User::all();
        $allUsers = \App\Models\User::with('roles')->get();

        return view('admin.users', ['users' => $allUsers]);
    }

    public function viewUser($id)
    {
        $user = \App\Models\User::where('id', '=', $id)->with('roles')->first();
        $allRoles = \App\Models\Role::all();

        return view('admin.userdetail')->with('user', $user)->with('roles', $allRoles);
    }

    public function editUser(Request $request)
    {
        $user = \App\Models\User::find($request->input('userid'));

        $user->attachRole($request->input('role'));

        return redirect('admin/userview/' . $request->input('userid'));
    }

    public function showRoles()
    {
        //$allRoles = \App\Models\Role::all();
        $allRoles = \App\Models\Role::with('perms')->get();
        $allPermissions = \App\Models\Permission::all();

        return view('admin.roles', ['roles' => $allRoles, 'permissions' => $allPermissions]);
    }

    public function editRoles(Request $request)
    {
        $action = $request->input('action');
        if ($action == 'ADD')
        {
            $role = new \App\Models\Role();
            $role->name = $request->input('rolename');
            $role->save();
        }
        elseif ($action == 'DELETE')
        {
            $roleId = $request->input('roleid');
            $role = \App\Models\Role::findOrFail($roleId);

            $role->delete();
        }
        elseif ($action == "EDITPERMS")
        {
            $role = \App\Models\Role::findOrFail($request->input('roleid'));
            $perms = $request->input('rolepermissions-' . $request->input('roleid'));

            $role->perms()->sync($perms);

        }

        return redirect('admin/roles');

    }

    public function showPermissions($id = null)
    {
        $allPermissions = \App\Models\Permission::all();

        $p = null;
        if ($id != null)
        {
            $p = \App\Models\Permission::find($id);
        }

        return view('admin.permissions', ['permissions' => $allPermissions, 'permission' => $p]);
    }

    public function editPermissions(Request $request)
    {
        $action = $request->input('action');
        if ($action == 'ADD') {

            $permission = new \App\Models\Permission();

            if ($request->input('permissionid') != '')
            {
                $permission = \App\Models\Permission::find($request->input('permissionid'));
            }

            $permission->name = $request->input('permissionname');
            $permission->display_name = $request->input('permissiondisplay');
            $permission->description  = $request->input('permissiondesc');
            $permission->save();

        }
        elseif ($action == 'DELETE')
        {
            $permissionId = $request->input('permissionid');
            $permission = \App\Models\Permission::findOrFail($permissionId);

            $permission->delete();
        }

        return redirect('admin/permissions');

    }

    public function showSearchIndexes()
    {
        $indexes = Storage::directories('lucene/');

        return view('admin.lucenesearch')->with('indexes', $indexes);
    }

    public function createSearchIndex(Request $request)
    {
        $indexInfo = array('index_name' => $request->input('newindex'), 'action' => 'CREATE');

        // Build index on creation
        $this->dispatch(new RebuildSearchIndex($indexInfo));

        return redirect('admin/searchindexes');
    }

    public function manageSearchIndex(Request $request)
    {
        $action = $request->input('indexaction');
        $indexName = $request->input('indexname');

        if($action == "REBUILD")
        {
            $indexInfo = array('index_name' => $indexName, 'action' => $action);
            $this->dispatch(new RebuildSearchIndex($indexInfo));
        }

        return redirect('admin/searchindexes');
    }

}