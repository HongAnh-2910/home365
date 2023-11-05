<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Helpers\HomeHelper;
use Illuminate\Support\Facades\Session;

class AuthController extends BaseController
{

    public function login()
    {
        $errorMessage = null;

        return view('auth.login', [
            'errorMessage' => $errorMessage,
            'oldSDT' => null
        ]);
    }

    public function loginExecute(Request $request)
    {
        $errorMessage = null;
        $this->validate($request, [
            'phone_number' => 'required|numeric|digits:10',
            'password' => 'required'
        ], [
            'phone_number.digits' => 'Số điện thoại không đúng',
            'phone_number.numberic' => 'Số điện thoại không đúng',
            'phone_number.required' => 'Số điện thoại không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
        ]);

        try {
            $params = [
                'MSISDN' => $request->get('phone_number'),
                'PASSWORD' => $request->get('password'),
            ];
            $serviceLogin = $this->callApiBaseCustomer('' ,'https://g3g4.vn/bg/serviceLogin' ,$params);
             $result = $serviceLogin->json();
//            $serviceLogin = Http::asForm()->post(HomeHelper::DOMAIN . '/serviceLogin', [
//                'MSISDN' => $request->get('phone_number'),
//                'PASSWORD' => $request->get('password'),
//            ]);

            if ($result['ERROR'] === '0000') {
                session(['SDT' => $request->get('phone_number')]);
                if (count($result['INFO']['CHILDS'])) {
                    $params = [
                        'USER_MOTHER' => $result['INFO']['USERNAME'],
                        'USER_CHILD' => $result['INFO']['CHILDS'][0]['USERNAME'],
                        'PASSWORD' => $result['INFO']['CHILDS'][0]['PASSWORD']
                    ];
                    $response = $this->callApiBaseCustomer('' ,'https://g3g4.vn/bg/login_child' ,$params);

                    $response = $response->json();

                    if ($response['ERROR'] === '0000') {
                        session()->forget(['USER_TOKEN', 'USER_INFO', 'DETAIL_EXERCISE', 'CURRENT_WEEK_TEST_ID', 'CURRENT_TEST_TEXT']);
                        session(['CURRENT_POINT' => 0.0]);
                        session(['USER_TOKEN' => $response['TOKEN']]);
                        session(['USER_INFO' => $response['INFO']]);

                        return redirect()->route('dashboard');
                    } else {
                        if (isset($result['INFO']['CHILDS'][1])) {
                            $params = [
                                'USER_MOTHER' => $result['INFO']['USERNAME'],
                                'USER_CHILD' => $result['INFO']['CHILDS'][1]['USERNAME'],
                                'PASSWORD' => $result['INFO']['CHILDS'][1]['PASSWORD']
                            ];
                            $response1 = $this->callApiBaseCustomer('' ,'https://g3g4.vn/bg/login_child' ,$params);;

                            $response1 = $response1->json();

                            if ($response1['ERROR'] === '0000') {
                                session()->forget(['USER_TOKEN', 'USER_INFO', 'DETAIL_EXERCISE', 'CURRENT_WEEK_TEST_ID', 'CURRENT_TEST_TEXT']);
                                session(['CURRENT_POINT' => 0.0]);
                                session(['USER_TOKEN' => $response1['TOKEN']]);
                                session(['USER_INFO' => $response1['INFO']]);

                                return redirect()->route('dashboard');
                            } else {
                                $errorMessage = $response['MESSAGE'] ?? HomeHelper::LOGIN_ERROR;
                            }
                        } else {
                            $errorMessage = $response['MESSAGE'] ?? HomeHelper::LOGIN_ERROR;
                        }
                    }
                }
            } else {
                $errorMessage = $result['MESSAGE'] ?? HomeHelper::LOGIN_ERROR;
            }

        } catch (\Exception $e) {
            $errorMessage = HomeHelper::LOGIN_ERROR;
        }


        return view('auth.login', [
            'errorMessage' => $errorMessage,
            'oldSDT' => $request->get('phone_number'),
        ]);
    }


    public function logout()
    {
        try {
            $response = Http::asForm()->withToken(session('USER_TOKEN'))->post(HomeHelper::DOMAIN . '/logout', [
                'USER_MOTHER' => session('USER_INFO')['PARENT_USERNAME'],
                'USER_CHILD' => session('USER_INFO')['USERNAME']
            ]);

            session()->forget(['USER_TOKEN', 'USER_INFO', 'DETAIL_EXERCISE', 'CURRENT_WEEK_TEST_ID', 'CURRENT_TEST_TEXT', 'CURRENT_POINT', 'LIST_DETAIL_TEST', 'EXCERCISE_ID_TEST']);
            return redirect()->route('auth.login');

        } catch (\Exception $e) {
            session()->forget(['USER_TOKEN', 'USER_INFO', 'DETAIL_EXERCISE', 'CURRENT_WEEK_TEST_ID', 'CURRENT_TEST_TEXT', 'CURRENT_POINT']);
            return redirect()->route('auth.login');
        }

    }

    public function register()
    {
        return view('auth.register');
    }


    public function registerSubmit(Request $request)
    {
        $this->validate($request, [
            'phone_number' => 'required|numeric|digits:10',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ], [
            'phone_number.digits' => 'Số điện thoại không đúng',
            'phone_number.numberic' => 'Số điện thoại không đúng',
            'phone_number.required' => 'Số điện thoại không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
            'password_confirmation.required' => 'Nhập lại mật khẩu không được để trống'
        ]);
        try {
            $arrayPrams         = [
                "UUID" => "F5N0CV138520194",
                "PHONE"  => $request->input('phone_number'),
                "PASS" => $request->input('password')
            ];
           $response = $this->callApiBaseCustomer('','http://14.162.146.147:3000/child/init' ,$arrayPrams);
           if($response["ERROR"] == "0000" || $response["MESSAGE"] == "SUCCESS")
           {
               return redirect()->route('auth.login');
           }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function profile(Request $request)
    {
        $profile_update = session("PROFILE");
        $info_profile = session("USER_INFO");
        $list_province = [];
        $list_district = [];
        $list_school = [];
        try {
            $response = Http::withToken(session('USER_TOKEN'))->asForm()->post(HomeHelper::DOMAIN . '/get_province',
                [
                    'USER_MOTHER' => session('USER_INFO')['PARENT_USERNAME'],
                    'USER_CHILD' => session('USER_INFO')['USERNAME'],
                ]);
            $list_province = $response->json();
//                get district
            $response_district = Http::withToken(session('USER_TOKEN'))->asForm()->post(HomeHelper::DOMAIN . '/get_district',
                [
                    'USER_MOTHER' => session('USER_INFO')['PARENT_USERNAME'],
                    'USER_CHILD' => session('USER_INFO')['USERNAME'],
                    'ID_PROVINCE' => $profile_update["PROVINCE_ID"] ?? 1,
                ]);
            $list_district = $response_district->json();
////            get school
            $response_school = Http::withToken(session('USER_TOKEN'))->asForm()->post(HomeHelper::DOMAIN . '/get_school',
                [
                    'USER_MOTHER' => session('USER_INFO')['PARENT_USERNAME'],
                    'USER_CHILD' => session('USER_INFO')['USERNAME'],
                    'ID_DISTRICT' => $profile_update["DISTRICT_ID"] ?? 1,
                ]);
            $list_school = $response_school->json();
        } catch (\Exception $e) {

        }

        return view('auth.profile', compact('list_province', 'list_district', 'list_school', 'info_profile', 'profile_update'));
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */

    public function profileAjax(Request $request)
    {
        $list_district = [];
        try {
            $response = Http::withToken(session('USER_TOKEN'))->asForm()->post(HomeHelper::DOMAIN . '/get_district',
                [
                    'USER_MOTHER' => session('USER_INFO')['PARENT_USERNAME'],
                    'USER_CHILD' => session('USER_INFO')['USERNAME'],
                    'ID_PROVINCE' => $request->input('value'),
                ]);
            $list_district = $response->json();
        } catch (\Exception $e) {

        }

        return view('auth.select_district', compact('list_district'));
    }

    /**
     * @param Request $request
     *
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|mixed
     */

    public function profileSchool(Request $request)
    {
        $list_school = [];
        try {
            $response_school = Http::withToken(session('USER_TOKEN'))->asForm()->post(HomeHelper::DOMAIN . '/get_school',
                [
                    'USER_MOTHER' => session('USER_INFO')['PARENT_USERNAME'],
                    'USER_CHILD' => session('USER_INFO')['USERNAME'],
                    'ID_DISTRICT' => $request->input('value_qh'),
                ]);
            $list_school = $response_school->json();
        } catch (\Exception $e) {

        }

        return view('auth.select_school', compact('list_school'));
    }

    /**
     * @param Request $request
     *
     * @return array
     */

    public function profileUpdate(Request $request)
    {
//       return Session::forget('PROFILE');
        $list_school = [];
        try {
            if ($request->district) {
                $response_school = Http::withToken(session('USER_TOKEN'))->asForm()->post(HomeHelper::DOMAIN . '/get_school',
                    [
                        'USER_MOTHER' => session('USER_INFO')['PARENT_USERNAME'],
                        'USER_CHILD' => session('USER_INFO')['USERNAME'],
                        'ID_DISTRICT' => $request->district,
                    ]);
                $list_school = $response_school->json();
                session(["LIST_SCHOOL" => $list_school]);
            }
        } catch (\Exception $e) {

        }
        $list_district = [];
        try {
            if ($request->input('province')) {
                $response = Http::withToken(session('USER_TOKEN'))->asForm()->post(HomeHelper::DOMAIN . '/get_district',
                    [
                        'USER_MOTHER' => session('USER_INFO')['PARENT_USERNAME'],
                        'USER_CHILD' => session('USER_INFO')['USERNAME'],
                        'ID_PROVINCE' => $request->input('province'),
                    ]);
                $list_district = $response->json();
                session(["LIST_DISTRICT" => $list_district]);
            }
        } catch (\Exception $e) {

        }
        $request->validate([
            'province' => 'required',
            'district' => 'required',
            'school' => 'required',
            'fullName' => 'required',
//            'phone'    => 'required|numeric|digits:10',
        ],
            [
                'required' => ":Attribute không được để trống",
                'phone.digits' => 'Số điện thoại không đúng',
                'phone.numberic' => 'Số điện thoại không đúng',
//                'phone.required' => 'Số điện thoại không được để trống',
            ],
            [
                'province' => "Tỉnh thành",
                'district' => "Quận Huyện",
                'school' => "Trường tiểu học",
                'fullName' => 'Họ và tên',
            ],

        );
        $info_profile = session("USER_INFO");
        try {
//            $response = Http::withToken(session('USER_TOKEN'))->asForm()->post(HomeHelper::DOMAIN . '/update_info2', [
//                'USER_MOTHER' => $info_profile["PARENT_USERNAME"],
//                'USER_CHILD'  => $info_profile["USERNAME"],
//                'ID_SCHOOL'   => $request->input("school"),
//                'ID_LEVEL'    => 4,
//                'CLASS'       => 22,
//                'CHILD_NAME'  => "trung333",
//                'CHILD_PASS'  => $info_profile["PASSWORD"],
//                'MOBILE'      => $request->input("phone"),
//                'EMAIL'       => $request->input("email"),
//                'LINK_AVATAR' => '',
//                'ISUPDATE'    => 2,
//            ]);
//            $response->json();
            $thumbnail = uploadImg($request, public_path() . '/uploads/');
//                save profile to session

            $list_update = [
                "PROVINCE_ID" => $request->input("province"),
                "DISTRICT_ID" => $request->input("district"),
                "SCHOOL_ID" => $request->input("school"),
                "FULL_NAME" => $request->input("fullName"),
                "SDT" => $request->input("phone"),
                "EMAIL" => $request->input("email"),
                "NAME_SCHOOL" => $request->input("level"),
                "THUMBNAIL" => $thumbnail ?? $request->input("test"),
            ];

            session(["PROFILE" => $list_update]);
            $sessionUpdateInfo = session("PROFILE");
            if (isset($sessionUpdateInfo)) {
                return redirect()->back()->with("success", "Cập nhật thông tin thành công");
            }

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
