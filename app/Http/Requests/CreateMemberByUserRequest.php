<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
class CreateMemberByUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'txtname'          => 'required|max:255',
            'add-gender'        => 'required',
            'txtbirthday'      => 'max:10',
            'txtaddress'       => 'max:255',
            'txtchild'     => 'required',
            'parent_id'     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'txtname.required'      => 'Tên không được bỏ trống.',
            'txtname.max'           => 'Tên nhập quá ký tự cho phép.',
            'add-gender.required'    => 'Giới tính bắt buộc phải chọn',
            'txtbirthday.max'       => 'Ngày sinh không đúng dịnh dạng.',
            'txtaddress.max'        => 'Địa chỉ nhập dài quá.',
            'txtchild.required'     => 'Không xác định đối tượng cần thêm!',
            'parent_id.required'    => 'Không xác định người có quan hệ trong gia đình!',
        ];
    }
}
