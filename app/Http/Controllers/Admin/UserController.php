<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Model\Role;
use App\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    protected $user;
    protected $role;
    public function __construct(User $user,Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = $request->status;
        $list_act = [
            'delete' => 'Xoa tam thoi'
        ];
        if($status == 'trash'){
            $list_act = [
                'restore' => 'Khoi Phuc',
                'forcedelete' => 'Xoa vinh vien'
            ];
            $users = $this->user->onlyTrashed()->get();
        }else{
            $users = $this->user->all();
        }
        $count_user_active = $this->user->count();
        $count_user_trash = $this->user->onlyTrashed()->count();
        $count = [$count_user_active,$count_user_trash];
        return view('admin.users.index',compact('users','count','list_act'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->role->all();
        return view('admin.users.add',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try{
            DB::beginTransaction();
            $dataUser = [
                'name' => $request->user_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];
            $user = $this->user->create($dataUser);
            $roles = $request->roles;
            $user->roles()->attach($roles);
            DB::commit();
            toast('Your User as been inserted!','success');
            return redirect()->route('admin.user.index');
        }catch(Exception $exception){
            DB::rollBack();
            Log::error('message' . $exception->getMessage(). 'line' . $exception->getLine());
        }
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
        $user = $this->user->find($id);
        $roles = $this->role->all();
        $rolesUser = $user->roles;
        return view('admin.users.edit',compact('user','roles','rolesUser'));
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

        try{
            DB::beginTransaction();
            if(!empty($request->password)){
                $dataUser = [
                    'name' => $request->user_name,
                    'password' => Hash::make($request->password),
                ];
            }else{
                $dataUser = [
                    'name' => $request->user_name,
                ];
            }
            $user = $this->user->find($id)->update($dataUser);
            $userItem = $this->user->find($id);
            $userItem->roles()->sync($request->roles);
            DB::commit();
            toast('Your User as been updated!','success');
            return redirect()->route('admin.user.index');
        }catch(Exception $exception){
            DB::rollBack();
            Log::error('message' . $exception->getMessage(). 'line' . $exception->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->user->findOrFail($id)->delete();
        toast('Your user as been deleted!','success');
        return redirect()->route('admin.user.index');
    }

    public function action(Request $request){
        $list_check =$request->list_check;
        $selectStatus =$request->selectStatus;
        if(!empty($list_check)){
                if($selectStatus == 'restore'){
                    $this->user->withTrashed()->whereIn('id',$list_check)->restore();
                    toast('Restore user successfull!','success');
                    return redirect()->route('admin.user.index');
                }else if($selectStatus == 'forcedelete'){
                    $this->user->whereIn('id',$list_check)->forceDelete();
                    toast('Delete permanently user successfull!','success');
                    return redirect()->route('admin.user.index');
                }else if($selectStatus ==  'delete'){
                    $this->user->whereIn('id',$list_check)->delete();
                    toast('Delete user successfull!','success');
                    return redirect()->route('admin.user.index');
                }

        }else{
            toast('Please select field delete!','error');
        }
        return redirect()->route('admin.user.index');
    }
}