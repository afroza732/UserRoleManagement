<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Auth;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $user;
    public function __construct(){
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('web')->user();
            return $next($request);
        }) ;
    }
    public function index()
    {
        if(is_null($this->user) || !$this->user->can('role.view')){
            abort('401', 'Unauthorized to access page');
        }
        $roles = Role::all();
        return view('admin.pages.roles.index',[
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('role.create')){
            abort('401', 'Unauthorized to access page');
        }
        $roles = Role::all();
        $permissionGroups = User::getPermissionGroup();
        //dd($permissionGroup);
        $allPermissions = Permission::all();
        return view('admin.pages.roles.create',[
            'roles' => $roles,
            'allPermissions' => $allPermissions,
            'permissionGroups' => $permissionGroups,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required||unique:roles'
        ],[
            'name.required' => 'Please give input name' 
        ]);
        $role = Role::create(['name' => $request->name]);
        $permissions = $request->input('permissions');

        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }
        session()->flash('success', 'Role has been created !!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(is_null($this->user) || !$this->user->can('role.edit')){
            abort('401', 'Unauthorized to access page');
        }
        $role = Role::find($id);
        $permissionGroups = User::getPermissionGroup();
        $allPermissions = Permission::all();
        return view('admin.pages.roles.edit',[
            'role' => $role,
            'allPermissions' => $allPermissions,
            'permissionGroups' => $permissionGroups,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|max:100|unique:roles,name,' . $id
        ],[
            'name.required' => 'Please give input name' 
        ]);
        $role = Role::find($id);
        $permissions = $request->input('permissions');

        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }
        session()->flash('success', 'Role has been updated !!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    
    {
        if(is_null($this->user) || !$this->user->can('role.delete')){
            abort('401', 'Unauthorized to access page');
        }
        $role = Role::findById($id);
       
        if (!is_null($role)) {
            $role->delete();
        }

        session()->flash('success', 'Role has been deleted !!');
        return back();
    }
}
