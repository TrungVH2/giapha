<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMemberByUserRequest;
use App\Http\Requests\CreateMemberRequest;
use App\Http\Requests\EditMemberRequest;
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

    public function  setChi(){
        $user = User::all();
        while (User::Where('branch_id','!=','null')->get()->count()>1){
            foreach ($user as $item){
                if($item->parent_id){
                    $father = User::find($item->parent_id);
                    if($father->branch_id){
                        $item->branch_id = $father->branch_id;
                        //dd($item->name . " - ".$item->branch_id);

                        $item->save();
                    }
                }
            }
        }

    }

    public function listMembers()
    {
        $listUser = User::all();
        return view('admin.users.list', ['listUser' => $listUser]);
    }

    public function getNewMember(Request $request)
    {
        $listParent = User::where('parent_id', '<>', null)->Orwhere('roles_id', '=', '3')->get();
        return view('admin.users.add', ['listParent' => $listParent]);
    }

    /**
     * get wife husband set for data dropdown wife or husband
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getWifeHusband(Request $request)
    {
        $userId = $request->get('userId');
        $user = new User();
        $wifeHusband = $user->getWifeOrHusband($userId);
        $familyUser =$user->getFamilyByUserId($userId);
        //return view('admin.users.add', compact('wifeHusband'));
        return response()->json(['wifeHusband' => $wifeHusband, 'familyUser' => $familyUser]);
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

    /**
     * userself add child or wife and husband
     * @param CreateMemberByUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUserSelfAddNewMember(CreateMemberByUserRequest $request)
    {
        $isChild = $request->get('txtchild');

        $parent = $request->get('parent_id');
        $parentId = $isChild == 1? $parent  : null;
        $motherId = $isChild == 1? $request->get('mother_id'): null;
        $husbandWifeId = $isChild == 0? $parent : null;

        $name = $request->get('txtname');
        $strName = $this->convertVNToEN($name);
        $username = str_replace(' ', '', $strName);
        $shortName = null;
        $gender = $request->get('add-gender');
        $birthday = $request->get('txtbirthday');
        $diedateAt = null;
        $address = $request->get('txtaddress');
        $phone = null;
        $email = null;
        $description = $request->get('txtdescription');
        $sortInFamily = $request->get('sort_in_family');
        $branchId = null;
        $layerId = null;
        if (!$email) {
            for ($i = 1; $i <= 500; $i++) {
                $setEmail = strtolower($username) . (string)$i . '@gmail.com';
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
            //$filename = $request->get('txtFile');
            $avatar = $request->file('fileAvatar')->getClientOriginalName();
            $filename = time() . '_' . $avatar;
            //$destination = base_path() . '/public/uploads';
            $destination =public_path('/uploads');
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
            'mother_id' => $motherId,
            'husband_wife_id' => $husbandWifeId,
            'branch_id' => $branchId,
            'layer_id' => $layerId,
            'roles_id' => '2',
            'user_id_add' => Auth::user()->id,
        ];
        if ($this->create($data)) {
            return redirect()->back()->with(['successful' => 'Thêm thành viên mới vào gia đình thành công!']);
        }

        return redirect()->back()->withErrors(['error' => 'Thêm thành viên thất bại!']);
    }

    /**
     * Admin add new
     * @param CreateMemberRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function postNewMember(CreateMemberRequest $request)
    {
        $isParent = $request->get('optionsRadiosIsParent');
        $parent = $request->get('txtparent_id');
        $motherId = $request->get('mother_id');
        $parentId = $isParent == 0 ? $parent : null;
        $husbandWifeId = $isParent == 1 ? $parent : null;
        $name = $request->get('txtname');
        $strName = $this->convertVNToEN($name);
        $username = str_replace(' ', '', $strName);
        $shortName = null;
        $gender = $request->get('txtgender');
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
                $setEmail = strtolower($username) . (string)$i . '@gmail.com';
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
            //$filename = $request->get('txtFile');
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
            'mother_id' => $motherId,
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
            'username' => $data['username'],
            'password' => $data['password'],
            'name' => $data['name'],
            'short_name' => $data['short_name'],
            'avatar' => $data['avatar'],
            'gender' => $data['gender'],
            'birthday' => $data['birthday'],
            'diedate_at' => $data['diedate_at'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'description' => $data['description'],
            'sort_in_family' => $data['sort_in_family'],
            'parent_id' => $data['parent_id'],
            'mother_id' => $data['mother_id'],
            'husband_wife_id' => $data['husband_wife_id'],
            'branch_id' => $data['branch_id'],
            'layer_id' => $data['layer_id'],
            'roles_id' => $data['roles_id'],
            'user_id_add' => $data['user_id_add'],
        ]);
    }

    public function getEditUser($userId)
    {
        $user = User::find($userId);
        $users = new User();
        $listParent = User::all();
        $children = $users->getChildrenByUserId($userId);
        $parent = null;
        if ($user->parent_id) {
            $parent = $users->getParentByParentId($user->parent_id);
        } elseif ($user->husband_wife_id) {
            //get parent id of husband's parent or wife's parent
            $parentId = User::find($user->husband_wife_id)->parent_id;
            //get husband's parent or wife's parent
            $parent = $users->getParentByParentId($parentId);
        }
        return view('admin.users.edit',
                    [
                        'user' => $user,
                        'parent' => $parent,
                        'listParent' => $listParent,
                        'children' => $children
                    ]);
    }

    public function postEditUser(EditMemberRequest $request)
    {
        $modUser= $request->get('mod-user');
        $userId = $request->get('txtuserid');
        $isParent = $request->get('optionsRadiosIsParent');
        $parent = $request->get('txtparent_id');
        $motherId = $request->get('mother_id');
        $parentId = $isParent == 0 ? $parent : null;
        $husbandWifeId = $isParent == 1 ? $parent : null;
        $name = $request->get('txtname');
        $strName = $this->convertVNToEN($name);
        $username = str_replace(' ', '', $strName);
        $shortName = null;
        $gender = $request->get('txtgender');
        $birthday = $request->get('txtbirthday');
        $diedateAt = $request->get('txtdiedate_at');
        $address = $request->get('txtaddress');
        $phone = $request->get('txtphone');
        $email = $request->get('email');
        $description = $request->get('txtdescription');
        //$sortInFamily = '1';
        $branchId = null;
        $layerId = null;

        $avatar = null;
        $filename = null;
        if ($request->hasFile('fileAvatar')) {
            //get img and save to local
            //$filname = $request->get('txtFile');
            $avatar = $request->file('fileAvatar')->getClientOriginalName();
            $filename = time() . '_' . $avatar;
            $destination = base_path() . '/public/uploads';
            //dd($destination);
            $request->file('fileAvatar')->move($destination, $filename);
        }

        $user = User::find($userId);

        if(!$avatar && ($user->avatar = 'man.png' || $user->avatar = 'girl.png' || $user->avatar = null)){
            if($gender == 1){
                $filename = 'man.png';
            }else{
                $filename = 'girl.png';
            }
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
            //'email' => $email,
            'description' => $description,
            //'sort_in_family' => $sortInFamily,
            'parent_id' => $parentId,
            'mother_id' => $motherId,
            'husband_wife_id' => $husbandWifeId,
            'branch_id' => $branchId,
            'layer_id' => $layerId,
            'user_id_add' => Auth::user()->id,
        ];

        if ($user) {
            $user->username = $data['username'];
            $user->password = $data['password'];
            $user->name = $data['name'];
            $user->short_name = $data['short_name'];
            $user->avatar = $data['avatar'];
            $user->gender = $data['gender'];
            $user->birthday = $data['birthday'];
            $user->diedate_at = $data['diedate_at'];
            $user->address = $data['address'];
            $user->phone = $data['phone'];
            //$user->email = $data['email'];
            $user->description = $data['description'];
            $user->sort_in_family = $user->sort_in_family;
            $user->parent_id = $data['parent_id'];
            $user->mother_id = $data['mother_id'];
            $user->husband_wife_id = $data['husband_wife_id'];
            $user->branch_id = $data['branch_id'];
            $user->layer_id = $data['layer_id'];
            $user->user_id_add = $data['user_id_add'];
            if ($user->save()) {
                if($modUser !='ModUser'){
                    return redirect()->route('list-members');
                }else{
                    return redirect()->back()->with(['successful' => 'Cập nhật thành công!']);
                }
            }
            return redirect()->back()->withErrors(['error' => 'Chỉnh sửa thông tin thất bại!']);
        } else {
            return redirect()->back()->withErrors(['error' => 'Thành viên này không tồn tại trong hệ thống!']);
        }

    }

    public function updateSortInFamily(Request $request){
        $userId = $request->get('userId');
        $sortNumber = $request->get('sortNumber');

        if($userId){
            $user = User::find($userId);
            $user->sort_in_family = $sortNumber;
            if($user->save()){
                return redirect()->back()->with(['successful' => 'Cập thứ tự thành công!']);
            }
        }
        return redirect()->back()->with(['successful' => 'Xảy ra lỗi cập nhật!']);
    }

    /**
     * Delete user by id
     * @param $userId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($userId)
    {
        if ($userId) {
            $users = User::find($userId);
            $users->delete();

            return redirect()->back()->with(['successful' => 'Xóa thành viên thành công!']);
        }
    }
}
