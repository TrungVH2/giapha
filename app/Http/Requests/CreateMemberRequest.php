<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
class CreateMemberRequest extends Request
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
            'txtgender'        => 'required',
            'txtbirthday'      => 'max:10',
            'txtdieldate_at'   => 'max:10',
            'txtaddress'       => 'max:255',
            'txtphone'         => 'max:11',
            'email'         => ['email', 'max:255', 'unique:users'],
            'txtparent_id'     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'txtname.required'      => 'Tên không được bỏ trống.',
            'txtname.max'          => 'Tên nhập quá ký tự cho phép.',
            'txtgender.required'    => 'Giới tính bắt buộc phải chọn',
            'txtbirthday.max'      => 'Ngày sinh không đúng dịnh dạng.',
            'txtdiedate_at.max'    => 'Ngày mất không đúng định dạng.',
            'txtaddress.max'       => 'Địa chỉ nhập dài quá.',
            'txtphone.max'         => 'Số điện thoại nhập tối đa 11 số thôi.',
            'txtemail.email'       => 'Email không đúng định dạng',
            'txtemail.max'         => 'Email không được nhập quá 255 ký tự.',
            'txtemail.unique'      => 'Email là để đăng nhập hệ thông vui lòng không nhập trùng.',
            'txtparent_id.required' => 'Chưa chọn người liên quan Bố, mẹ/ Vợ chồng.',
        ];
    }
}
