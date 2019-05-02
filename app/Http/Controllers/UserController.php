<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMemberRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function listMembers()
    {
        $listUser = User::all();
        return view('admin.users.list', ['listUser' => $listUser]);
    }

    public function getNewMember(Request $request)
    {
        $xx = $request->get('userId');
        if ($xx != null)
            dd($xx);
        $listParent = User::all();
        return view('admin.users.add', ['listParent' => $listParent]);
    }

    /**
     * @param $str
     * @return string|string[]|null
     */
    public function convertVNToEN($str)
    {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);

        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        return $str;
    }

    /**
     * Check email exits in system
     * @param $email
     * @return bool
     */
    public function checkExitsEmail($email)
    {
        $result = true;
        $users = new User();
        $users = $users->checkExitsEmail($email);
        if (!$users) {
            $result = false;
        }
        return $result;
    }

    public function postNewMember(CreateMemberRequest $request)
    {
        $isParent = $request->get('optionsRadiosIsParent');
        $parent = $request->get('txtparent_id');
        $parentId = $isParent == 0 ? $parent : null;
        $husbandWifeId = $isParent == 1 ? $parent : null;
        $name = $request->get('txtname');
        $strName = $this->convertVNToEN($name);
        $username = str_replace(' ', '', $strName);
        $shortName = null;
        $gender = $request->get('txtgender') == 'on' ? 1 : 0;
        $birthday = $request->get('txtbirthday');
        $diedateAt = $request->get('txtdiedate_at');
        $address = $request->get('txtaddress');
        $phone = $request->get('txtphone');
        $email = $request->get('email');
        $description = $request->get('txtdescription');
        $sortInFamily = '1';
        $branchId = null;
        $layerId = null;
        if (!$email) {
            for ($i = 1; $i <= 500; $i++) {
                $setEmail = $username . (string)$i . '@gmail.com';
                if (!$this->checkExitsEmail($setEmail)) {
                    $email = $setEmail;
                    break;
                }
            }
        }

        $avatar = null;
        $filename = null;
        if ($request->hasFile('fileAvatar')) {
            //get img and save to local
            //$filname = $request->get('txtFile');
            $avatar = $request->file('fileAvatar')->getClientOriginalName();
            $filename = time() . '_' . $avatar;
            $destination = base_path() . '/public/uploads';
            $request->file('fileAvatar')->move($destination, $filename);
        }

        if (!$avatar && ($gender == 1)) {
            $filename = 'man.png';
        }

        if (!$avatar && ($gender == 0)) {
            $filename = 'girl.png';
        }

        $data = [
            'username' => $username,
            'password' => Hash::make('0974839268'),
            'name' => $name,
            'short_name' => $shortName,
            'avatar' => $filename,
            'gender' => $gender,
            'birthday' => $birthday,
            'diedate_at' => $diedateAt,
            'address' => $address,
            'phone' => $phone,
            'email' => $email,
            'description' => $description,
            'sort_in_family' => $sortInFamily,
            'parent_id' => $parentId,
            'husband_wife_id' => $husbandWifeId,
            'branch_id' => $branchId,
            'layer_id' => $layerId,
            'roles_id' => '2',
            'user_id_add' => Auth::user()->id,
        ];
        if ($this->create($data)) {
            return redirect()->back()->with(['successful' => 'Thêm thành viên thành công!']);
        }

        return redirect()->back()->withErrors(['error' => 'Thêm thành viên thất bại!']);
    }

    //Create user
    protected function create(array $data)
    {
        return User::create([
            'username'  => $data['username'],
            'password'  => $data['password'],
            'name'      => $data['name'],
            'short_name' => $data['short_name'],
            'avatar'    => $data['avatar'],
            'gender'    => $data['gender'],
            'birthday'  => $data['birthday'],
            'diedate_at'=> $data['diedate_at'],
            'address'   => $data['address'],
            'phone'     => $data['phone'],
            'email'     => $data['email'],
            'description' => $data['description'],
            'sort_in_family' => $data['sort_in_family'],
            'parent_id' => $data['parent_id'],
            'husband_wife_id' => $data['husband_wife_id'],
            'branch_id' => $data['branch_id'],
            'layer_id'  => $data['layer_id'],
            'roles_id'  => $data['roles_id'],
            'user_id_add' => $data['user_id_add'],
        ]);
    }
}
