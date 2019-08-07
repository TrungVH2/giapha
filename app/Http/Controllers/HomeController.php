<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public  function testTree(){
        return view('tree.test-tree');
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

    public function getTree($show = '')
    {
        $user = new User();
        $userIndex = $user->getMembersIndex();

        if ($show == 'show-ho') {
            return view('tree-ho', ['userIndex' => $userIndex]);
        }

        if ($show == 'show-name') {
            return view('tree-name', ['userIndex' => $userIndex]);
        }

        return view('tree.tree', ['userIndex' => $userIndex]);
    }

    /**
     * get wife or husband full
     *
     * @param $id
     */
    public function showWifeHusband($id)
    {
        $wife = $this->getWifeHusband($id);
        //dd($wife);
        // show wife and husband
        if ($wife) {
            foreach ($wife as $k => $it) {
                echo '<div class="show-wife-husband">';
                echo '<img class="img-user" src="../uploads/' . $it['avatar'] . '" style="width: 75px; height: 100px"><p>-';
                echo $it['name'];
                echo '</p>';
                echo '</div>';
            }
        }
    }

    /**
     * Get list wife or husband
     *
     * @param $idPerant
     * @return mixed
     */
    public function getWifeHusband($userId)
    {
        $user = new User();
        $wifeHusband = $user->getWifeOrHusband($userId);
        return $wifeHusband;
    }

    /**
     * get chilrend full
     * @param $idPerant
     */
    public function getListChilrend($idPerant)
    {
        $list = $this->getChild($idPerant);

        if (count($list) > 0) {
            echo '<ul>';
            foreach ($list as $key => $item) {

                echo '<li>';
                echo '<a href="/tree/' . $item['id'] . '/view-detail">';
                echo '<div>';
                echo '<img class="img-user" src="../uploads/' . $item['avatar'] . '" style="width: 75px; height: 100px"><p>';
                echo $item['name'];
                echo '</p>';
                echo '</div>';

                echo $this->showWifeHusband($item['id']);

                echo '</a>';
                // Xóa chuyên mục đã lặp
                unset($list[$key]);
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                $this->getListChilrend($item['id']);
                echo '</li>';

            }
            echo '</ul>';
        }
    }

    /**
     * get list chilrend of parent
     *
     * @param $idPerant
     * @return mixed
     */
    public function getChild($idPerant)
    {
        $user = new User();
        $userChild = $user->getChildrenByUserId($idPerant);
        return $userChild;
    }

    public function getDetailUser($userId)
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
        return view('tree.detail',
            [
                'user' => $user,
                'parent' => $parent,
                'listParent' => $listParent,
                'children' => $children
            ]);
    }
}
