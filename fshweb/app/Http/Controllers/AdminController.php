<?php

namespace App\Http\Controllers;

use App\CacheManager;
use App\DataAccessLayer;
use App\iProductImporter;
use Illuminate\Http\Request;
use Storage;
use Validator;
use Ramsey\Uuid\Uuid;

use App\Jobs\RebuildSearchIndex;
use App\ProductImportOptions;
use App\UploadHandler;
use App\Models\User;
use App\Models\ProductImport;
use App\Http\Requests;
use App\Jobs\ParseProductImport;
use App\Models\Role;
use App\Models\Permission;

class AdminController extends Controller
{

    protected $dataAccess;
    protected $productImporter;
    protected $cacheManager;

    /**
     * AdminController constructor.
     * @param $dataAccess
     */
    public function __construct(DataAccessLayer $dataAccess, iProductImporter $productImporter, CacheManager $cacheManager)
    {
        $this->dataAccess = $dataAccess;
        $this->productImporter = $productImporter;
        $this->cacheManager = $cacheManager;
    }

    public function index()
    {
        return view('admin.home');
    }

    public function showImport()
    {
        // Get all vendors in the system
        $vendors = $this->dataAccess->getVendors(['id', 'company_name']);

        return view('admin.import')->with('vendors', $vendors);
    }

    public function doImport(Request $request)
    {
        /*===============================================================================*/
        // Adjust these upload  / script execution time settings just for CSV uploads
        /*===============================================================================*/
        ini_set('upload_max_filesize', config('app.product_import_upload_max_filesize'));
        ini_set('post_max_size', config('app.product_import_post_max_size'));
        ini_set('max_input_time', config('app.product_import_max_input_time'));
        ini_set('max_execution_time', config('app.product_import_max_execution_time'));

        if($request->hasFile('importfile'))
        {
            $filename = $request->file('importfile')->getClientOriginalName();
            $directory = Uuid::uuid4()->toString();

            $uploader = new UploadHandler();
            $result = $uploader->uploadCsv($request->file('importfile'), $directory, $filename);
            if($result)
            {
                $importInfo = new ProductImportOptions();
                $importInfo->setVendorId($request->input('vendor'));
                $importInfo->setUuid($directory);
                $importInfo->setFileName($filename);
                $importInfo->setIncludeHeaders($request->input('includesheaders') ? true : false);
                $importInfo->setAddAsActive($request->input('addasactive') ? true : false);
                $importInfo->setIgnoreExisting($request->input('ignoreexisting') ? true : false);
                $importInfo->setSimulate($request->input('simulate') ? true : false);
                $importInfo->setDownloadImages($request->input('downloadimages') ? true : false);
                $importInfo->setResizeImages($request->input('resizeimages') ? true : false);
                $importInfo->setResizeImageWidth($request->input('imagewidth'));
                $importInfo->setResizeImageHeight($request->input('imageheight'));

                $action = $request->input('action');

                if($action === 'PROCESS')
                {
                    if($result)
                    {
                        $this->dispatch(new ParseProductImport($importInfo));

                        echo "Done!";
                    }
                }
                else if($action === 'PREVIEW')
                {
                    $previewData = $this->productImporter->doPreview($importInfo);
                    return view('admin.importpreview')->with('previewData', $previewData);
                }
            }
        }
    }

    public function showUsers()
    {
        $allUsers = $this->dataAccess->getAllUsers();

        return view('admin.users', ['users' => $allUsers]);
    }

    public function showUserAdd()
    {
        $allRoles = $this->dataAccess->getAllRoles();

        return view('admin.useradd')->with('roles', $allRoles);
    }

    public function addUser(Request $request)
    {
        $isValid =  Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        if($isValid)
        {
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
            ]);

            if(!is_null($request['role']))
            {
                // Add to 'user' role
                $user->attachRole($request['role']);
            }
        }

        return redirect('admin/users');
    }

    public function viewUser($id)
    {
        $user = $this->dataAccess->getUser($id, 'roles');
        $allRoles = $this->dataAccess->getAllRoles();

        return view('admin.userdetail')->with('user', $user)->with('roles', $allRoles);
    }


    public function editUser(Request $request)
    {
        $user = $this->dataAccess->getUser($request->input('userid'), 'roles');

        if($request->input('password') != '')
        {
            $user->password = bcrypt($request->input('password'));
            $user->save();
        }

        $user->detachRoles($user->roles);

        $user->attachRole($request->input('role'));

        return redirect('admin/userview/' . $request->input('userid'));
    }

    public function showRoles()
    {
        $allRoles = $this->dataAccess->getAllRoles('perms');
        $allPermissions = $this->dataAccess->getAllPermissions();

        return view('admin.roles', ['roles' => $allRoles, 'permissions' => $allPermissions]);
    }

    public function editRoles(Request $request)
    {
        $action = $request->input('action');
        if ($action == 'ADD')
        {
            $role = new Role();
            $role->name = $request->input('rolename');
            $role->save();
        }
        elseif ($action == 'DELETE')
        {
            $roleId = $request->input('roleid');
            $role = Role::findOrFail($roleId);

            $role->delete();
        }
        elseif ($action == "EDITPERMS")
        {
            $role = Role::findOrFail($request->input('roleid'));
            $perms = $request->input('rolepermissions-' . $request->input('roleid'));

            $role->perms()->sync($perms);

        }

        return redirect('admin/roles');

    }

    public function showPermissions($id = null)
    {
        $allPermissions = $this->dataAccess->getAllPermissions();

        $p = null;
        if ($id != null)
        {
            $p = Permission::find($id);
        }

        return view('admin.permissions', ['permissions' => $allPermissions, 'permission' => $p]);
    }

    public function editPermissions(Request $request)
    {
        $action = $request->input('action');

        if ($action == 'ADD')
        {

            $permission = new Permission();

            if ($request->input('permissionid') != '')
            {
                $permission = Permission::find($request->input('permissionid'));
            }

            $permission->name = $request->input('permissionname');
            $permission->display_name = $request->input('permissiondisplay');
            $permission->description  = $request->input('permissiondesc');
            $permission->save();

        }
        elseif ($action == 'DELETE')
        {
            $permissionId = $request->input('permissionid');
            $permission = Permission::findOrFail($permissionId);

            $permission->delete();
        }

        return redirect('admin/permissions');

    }

    public function showCacheManager()
    {
        return view('admin.cache');
    }

    public function editCache(Request $request)
    {
        $action = $request->input('action');
        if($action === 'key')
        {
            $this->cacheManager->deleteItem(env('CACHE_DRIVER'), $request->input('cachekey'));
        }
        else if($action === 'flush')
        {
            $this->cacheManager->flushCache(env('CACHE_DRIVER'));
        }

        return redirect('admin/cache');
    }
}