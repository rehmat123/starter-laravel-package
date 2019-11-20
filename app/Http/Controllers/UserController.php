<?php

namespace app\Http\Controllers;

use Auth;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\UserDetail;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\User;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use Yajra\DataTables\DataTables;


class UserController extends Controller
{


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        return view('user.index');
    }

    public function create(Request $request){

        $roles = [];
        try {
            $rol = Role::all(['id', 'display_name'])->toArray();
            foreach ($rol as $key => $val) {
                $roles[$val['id']] = $val['display_name'];
            }
        } catch (\Exception $ex) {
            Session::flash("error", $ex->getMessage() . ' Line No ' . $ex->getLine());
            redirect('user');
        } catch (\Throwable $ex) {
            Session::flash("error", $ex->getMessage() . ' Line No ' . $ex->getLine());
            redirect('user');
        }

        return view('user.create')->with([
            'title' => 'Home',
            'bread' => 'User Creation',
            'roles' => $roles,
            'default' => $rol,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'email|required|unique:users',
            'password' => 'string|required|confirmed',
            'password_confirmation' => 'required|required_with:password|string',
            'roleId' => 'required|integer'
        ]);
        try {
            DB::beginTransaction();
            $hash = Hash::make($request->post('password'));
            $data = $request->except('roleId');
            $roleId = $request->post('roleId');
            $data = array_merge($data, ['password' => $hash]);
            $user = User::create($data);
            if ($user) {
                $detail = new UserDetail();
                $detailData = [
                    'user_id' => $user->id,
                    'country_id' => 0,
                    'state_id' => 0,
                    'city_id' => 0,
                    'ip' => 0,
                    'active' => 1,
                    'created_by' => auth()->user()->id ?? 1,
                    'updated_by' => 0,
                    'deleted' => 0,
                ];
                if (RoleUser::create(['user_id' => $user->id, 'role_id' => $roleId]) &&
                    $detail->create($detailData)) {
                    Session::flash('success', 'User Created Successfully');
                    DB::commit();
                }
            }
        } catch (\Exception $ex) {
            DB::rollBack();
            Session::flash('error', $ex->getMessage() . 'Line No ' . $ex->getLine());
        }

        return redirect('/user');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */

    public function edit($id){

        $action = $id != null ? 'user.update' : 'store';
        $assignRole = '';
        $roles = [];
        try {
            $data = User::where('id', '=', $id)->get()->first();
            $rol = Role::all(['id', 'display_name'])->toArray();


              if ($id != null) {
                  $assignRole = RoleUser::where('user_id', '=', $id)->first()->toArray()['role_id'];

              }

            foreach ($rol as $key => $val) {
                $roles[$val['id']] = $val['display_name'];
            }
        } catch (\Exception $ex) {
            Session::flash("error", $ex->getMessage() . ' Line No ' . $ex->getLine());
            redirect('user');
        } catch (\Throwable $ex) {
            Session::flash("error", $ex->getMessage() . ' Line No ' . $ex->getLine());
            redirect('user');
        }

        return view('user.edit')->with([
            'title' => 'Home',
            'bread' => 'User Update',
            'data' => $data,
            'id' => $id,
            'roles' => $roles,
            'default' => $assignRole,
            'action' => $action
        ]);
    }
    public function show()
    {

        $data = User::join('user_details', 'user_details.user_id', '=', 'users.id')
            ->leftjoin("role_user", "role_user.user_id", "=", "users.id")->
            where([
//                ['users.id', '=', 14],
//                ['users_detail.active', '=', 1]
            ])->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                $class = $row->active == 1 ? 'success' : 'danger';
                $col = '<span class="label alert-' . $class . '">';
                $col .= $row->active == 1 ? ' Active ' : ' Deactive ';
                $col .= "</span>";
                return $col;
            })
            ->addColumn('action', function ($row) {

                $btn = '<a title="Change Status" href="' . route('user.status', $row->id) . '" class="edit btn btn-primary btn-sm">
              <span class="glyphicon glyphicon-refresh"></span></a>';
                $btn .= '  <a title="Edit" href="' . route('user.edit', $row->user_id) . '" class="edit btn btn-primary btn-sm">
              <span class="glyphicon glyphicon-edit"></span></a>';
                $btn .= '  <a title="Delete" style="background: indianred;" href="' . route('user.delete', $row->user_id) . '" class="edit btn btn-primary btn-sm">
              <span style="color:#fff;" class="glyphicon glyphicon-trash"></span></a>';
                return $btn;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request)
    {
        $id = $request->post('id');
        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'email|required',
            'password' => 'string|required|confirmed',
            'password_confirmation' => 'required|required_with:password|string',
            'roleId' => 'required|integer'
        ]);

        try {
            $hash = Hash::make($request->post('password'));
            $data = $request->except(['roleId', '_token', 'password_confirmation']);
            $roleId = $request->post('roleId');
            $data = array_merge($data, ['password' => $hash]);
            $user = User::whereId($id)->update($data);
            if ($user) {
                $detail = UserDetail::where('user_id', '=', $id);
                $detailData = [
                    'user_id' => $id,
                    'country_id' => 0,
                    'state_id' => 0,
                    'city_id' => 0,
                    'ip' => 0,
                    'active' => 1,
                    'updated_by' => auth()->user()->id,
                    'deleted' => 0,
                ];
                $detail->update($detailData);
                RoleUser::where('user_id', '=', $id)->update(['role_id' => $roleId]);
                Session::flash('success', 'User Updated Successfully');

            }
        } catch (\Exception $ex) {

            Session::flash('error', $ex->getMessage() . ' Line No :' . $ex->getLine());
        }

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            User::where("id", '=', $id)->delete();
            Session::flash('success', 'User Deleted');

        } catch (FatalThrowableError $ex) {
            Session::flash('error', $ex->getMessage() . ' Line No.' . $ex->getLine());
        }
        return redirect('');
    }


    public function status($id = null)
    {
        try {
            $data = UserDetail::find(['user_id' => $id])->first();
            $data->active = ($data->active == 1) ? 0 : 1;
            if ($data->save()) {
                Session::flash('success', 'Status Changes Successfully');
            }

        } catch (\Exception $ex) {
            Session::flash('error', $ex->getMessage() . 'Line No' . $ex->getLine());
        }
        return redirect('/user');
    }


}
