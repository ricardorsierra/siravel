<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/**
 * Class AppController.
 *
 * @author Amrani Houssain <amranidev@gmail.com>
 */
class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $users = \App\Models\User::all()->count();
        $roles = \App\Models\Role::all()->count();
        $permissions = \Spatie\Permission\Models\Permission::all()->count();
        $entities = \Amranidev\ScaffoldInterface\Models\Scaffoldinterface::all();

        return view('admin.dashboard.dashboard', compact('users', 'roles', 'permissions', 'entities'));
    }
}
