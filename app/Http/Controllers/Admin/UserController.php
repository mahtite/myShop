<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Rules\Recaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function __construct()
    {
      //  $this->middleware('can:users,user')->only(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //SearchAjax
        if($request->ajax())
        {
            $output="";
            $users=DB::table('users')->where('name','LIKE','%'.$request->search."%")
                ->get();

            if($users)
                {
                    $i=1;
                foreach ($users as $key => $user)
                {

                    $output.='<tr>'.
                        '<td>'.$i.'</td>
                        <td>'.$user->name.'</td>
                        <td>'.$user->phone.'</td>
                        <td>'.$user->email.'</td>
                     
                     </tr>';

                    $i++;
                }
                return Response($output);
            }
        }

        /******************************************************/

        $users=User::all();
        return  view('admin.users.all',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $request['password']=Hash::make($request['password']);
        User::create($request->all());
        //return back();

        $users=User::all();
        toast()->success('کاربر جدید ایجاد شد');
        return  view('admin.users.all',compact('users'));
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
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable',
        ]);
        if($request['password']){
            $request->validate([
            'password'=>['required', 'string', 'min:8', 'confirmed']
        ]);
        }

        $request['password']=Hash::make($request['password']);
        $user->update($request->all());
        toast()->success('ویرایش انجام شد');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        toast()->success('حذف انجام شد');
        return back();
    }

    public function addRole(User $user){
        $roles=Role::all();
        $permissions=Permission::all();
        return view('admin.users.roles',compact('user','roles','permissions'));
    }

    public function updateRole(User $user,Request $request){
        $user->roles()->sync($request->roles);
        $user->permissions()->sync($request->permissions);
        return back();
    }


    public function get_student_data()
    {
        return Excel::download(new UsersExport, 'students.xlsx');
    }
}
