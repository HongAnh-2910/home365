<?php

namespace App\Http\Controllers;

use App\Helpers\HomeHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;

class HomeController extends BaseController
{
    public function home()
    {
        return view('home.content');
    }

    public function terms()
    {
        return view('info.terms');
    }

    public function infoSecurity()
    {
        return view('info.security');
    }

    public function joinNow()
    {
        return view('join_now');
    }

    public function dashboard()
    {
        try {
            $response = Http::withHeaders(['Content-Type' => 'application/json'])->withToken(HomeHelper::BEARER_TOKEN)->post(HomeHelper::DOMAIN.'/getListSvs', [
                'PARENT_ID' => session('USER_INFO')['PARENT_ID'],
                'SERVICE_CODE' => session('USER_INFO')['VIP_NAME']
            ]);
            $data = $response->json();

            if($data['code'] === 0) {
                return redirect()->route('auth.logout');
            }

            $package = $data['data'][0] ?? '';
        } catch(\Exception $e) {
            $response = Http::withHeaders(['Content-Type' => 'application/json'])->withToken(HomeHelper::BEARER_TOKEN)->post(HomeHelper::DOMAIN.'/getListSvs', [
                'SERVICE_CODE' => 'DEFAULT'
            ]);
            $data = $response->json();
            $package = $data['data'][0];
        }
        $content = $package['DESCRIPTION'] ?? '';
        $descriptions = explode("\n", $content);

        return view('dashboard.index', [
            'userInfo'    => session("USER_INFO"),
            'package'     => $package,
            'descriptions' => $descriptions
        ]);
    }

    public function changeClass()
    {
        try {
            $changeLogin = Http::asForm()->withToken(session('USER_TOKEN'))->post(HomeHelper::DOMAIN . '/get_list_children', [
                'USER_MOTHER' => session('USER_INFO')['PARENT_USERNAME'],
                'USER_CHILD'  => session('USER_INFO')['USERNAME'],
            ]);

            $result = $changeLogin->json();

            if($result['ERROR'] !== '0000') {
                return redirect()->route('dashboard')->with('_error_message', $result['RESULT']);
            }

            $classList = $result['INFO'];

        } catch(\Exception $e) {
             return redirect()->route('dashboard')->with('_error_message', $e->getMessage());
        }

        return view('change_class', [
            'classList' => $classList,
            'currentLevel' => session('USER_INFO')['LEVEL_ID'],
            'currentUN' => session('USER_INFO')['USERNAME'],
            'currentPW' => session('USER_INFO')['PASSWORD']
        ]);
    }

    public function changeClassUpdate(Request $request)
    {
//        return session('USER_INFO');
        $this->validate($request, [
            'child_class' => 'required',
            'check_class' => 'required'
        ], [
            'child_class.required' => 'Có lỗi xảy ra khi chọn lớp, vui lòng thử lại',
            'check_class.required' => 'Có lỗi xảy ra, chưa xác nhận <b class="text-danger">"Tôi không phải người máy"</b>',
        ]);

        $parentUser    = session('USER_INFO')['PARENT_USERNAME'];
        $childUser     = $request->child_user;
        $childPassword = $request->child_bm;
        $childClass    = $request->child_class;
//        dd($childUser , $childPassword , $childClass);
        if($childUser == session('USER_INFO')['USERNAME']) {
            return redirect()->route('dashboard');
        }

        if($childUser) {
            try {
                $response = $this->loginApi($parentUser, $childUser, $childPassword);

                if ($response['ERROR'] === '0000') {
                    session(['USER_TOKEN' => $response['TOKEN']]);
                    session(['USER_INFO' => $response['INFO']]);
                    return redirect()->route('dashboard');
                } else {
                    return redirect()->route('change_class')->with('_error_message', $response['RESULT']);
                }
            }  catch (\Exception $e) {
                return redirect()->route('change_class')->with('_error_message', $e->getMessage());
            }
        } else {
            try {
                $create = Http::asForm()->post(HomeHelper::DOMAIN . '/child/init', [
                    'APP_VERSION'  => '1.0',
                    'DEVICE_MODEL' => 'web',
                    'TOKEN_KEY'    => session('USER_TOKEN'),
                    'DEVICE_TYPE'  => '3',
                    'UUID'         => 'WEB',
                    'OS_VERSION'   => '',
                    'PARENT_ID'    => session('USER_INFO')['PARENT_ID'],
                ]);

                $create = $create->json();

                if ($create['ERROR'] === '0000') {
                    $response = $this->loginApi($create['USER_MOTHER'], $create['USER_CHILD'], $create['PASSWORD']);

                    if ($response['ERROR'] === '0000') {
                        session(['USER_TOKEN' => $response['TOKEN']]);
                        $session = $response['INFO'];

                        $update = Http::withToken($response['TOKEN'])->asForm()->post(HomeHelper::DOMAIN . '/update_info2', [
                            'USER_MOTHER' => $create['USER_MOTHER'],
                            'USER_CHILD'  => $create['USER_CHILD'],
                            'ID_LEVEL'    => $childClass,
                            'CLASS'       => $childClass,
                            'CHILD_PASS'  => $create['PASSWORD'],
                            'ISUPDATE'    => 1
                        ]);

                        if($update['ERROR'] === '0000') {
                            $session['CLASS'] = $childClass;
                            $session['LEVEL_ID'] = $childClass;
                            session(['USER_INFO' => $session]);
                        } else {
                            return redirect()->route('change_class')->with('_error_message', $response['RESULT']);
                        }


                        return redirect()->route('dashboard');
                    } else {
                        return redirect()->route('change_class')->with('_error_message', $response['RESULT']);
                    }
                } else {
                    return redirect()->route('change_class')->with('_error_message', $create['RESULT']);
                }

            } catch (\Exception $e) {
                return redirect()->route('change_class')->with('_error_message', $e->getMessage());
            }
        }
    }

    public function listServices()
    {
        $listPackages = [];
        try {
            $response = Http::withHeaders(['Content-Type' => 'application/json'])->withToken(HomeHelper::BEARER_TOKEN)->post(HomeHelper::DOMAIN.'/getListSvs', []);
            $data = $response->json();
            if($data['code'] == 1) {
                foreach ($data['data'] as $item) {
                    if($item['PRICE'] < 50000) {
                        continue;
                    }

                    $listPackages[] = $item;
                }
            } else {
                return redirect()->route('dashboard')->with('_error_message', $data['message']);
            }
        } catch(\Exception $e) {
            return redirect()->route('dashboard')->with('_error_message', $e->getMessage());
        }

        return view('dashboard.list_services', [
            'listPackages' => $listPackages
        ]);
    }

    public function exerciseTakenDetail(Request $request ,$id)
    {
        try {
            $exeTakenDetail = Http::asForm()->withToken(session('USER_TOKEN'))->post(HomeHelper::DOMAIN . '/get_exe_detail_taken', [
                'USER_MOTHER'  => session('USER_INFO')['PARENT_USERNAME'],
                'USER_CHILD'   => session('USER_INFO')['USERNAME'],
                'ID_EXCERCISE' => $id
            ]);


            $exeTakenDetail = $exeTakenDetail->json();

            if($exeTakenDetail['ERROR'] !== '0000') {
                return redirect()->route('exercise-done')->with('_error_message', $exeTakenDetail['RESULT']);
            }
        } catch(\Exception $e) {
            return redirect()->route('exercise-done')->with('_error_message', $e->getMessage());
        }
        return view('exercise.exercise_taken_detail', [
            'takenDetail' => $exeTakenDetail['DETAILS']
        ]);
    }

    public function actionTakenDetail(Request $request, $id)
    {
        $arrImages = ['/images/type22_1.png', '/images/type22_2.png', '/images/type22_3.png', '/images/type22_4.png'];
        $arrBackgrounds = ['#F2C94C', '#6FCF97', '#56CCF2', '#FF6551'];
        $arrKeys = ['#D4B208', '#069306', '#1191DB', '#DB1C39'];
        $arrBackgrounds1 = ['#F2994A', '#F2C94C', '#6FCF97', '#56CCF2', '#D493ED', '#FF6551'];
        $status_url = 1;
        $status_type =0;

        if($request->status) {
            $status_url = $request->status;
        }

        if($request->type) {
            $status_type = $request->type;
        }
        try {
            $exeTakenDetail = Http::asForm()->withToken(session('USER_TOKEN'))->post(HomeHelper::DOMAIN . '/get_exe_detail_taken', [
                'USER_MOTHER'  => session('USER_INFO')['PARENT_USERNAME'],
                'USER_CHILD'   => session('USER_INFO')['USERNAME'],
                'ID_EXCERCISE' => $id
            ]);


            $exeTakenDetail = $exeTakenDetail->json();

            if($exeTakenDetail['ERROR'] !== '0000') {
                return redirect()->route('exercise-done')->with('_error_message', $exeTakenDetail['RESULT']);
            }

            $check_type = $exeTakenDetail['DETAILS']['PARTS'];
            if(count($check_type)) {
                for ($i = 0; $i < count($check_type); $i++) {
                    if(count($check_type[$i]['INFO'])) {
                        for ($j = 0; $j < count($check_type[$i]['INFO']); $j++) {
                            $check_type[$i]['INFO'][$j]['RESULT_CHILD'] = true;
                        }
                    }

                    if($check_type[$i]["KIEU"] == 11 || $check_type[$i]['KIEU'] == 5 || $check_type[$i]['KIEU'] == 4) {
                        for ($j = 0; $j < count($check_type[$i]['INFO']); $j++) {
                            $isCorrect = true;
                            $compareData = $check_type[$i]['INFO'][$j];
                            if($check_type[$i]["KIEU"] == 4) {
                                if($compareData['HTML_CONTENT'] != $compareData['ANSWER_CHILD']) {
                                    $isCorrect = false;
                                }
                            } else {
                                if($compareData['HTML_A'] != $compareData['EGG_1_RESULT'] || $compareData['HTML_B'] != $compareData['EGG_2_RESULT'] || $compareData['HTML_C'] != $compareData['EGG_3_RESULT'] || $compareData['HTML_D'] != $compareData['EGG_4_RESULT']) {
                                    $isCorrect = false;
                                }
                            }

                            $check_type[$i]['INFO'][$j]['is_correct'] = $isCorrect;
                        }
                    }
                }
            }

            session(['CURRENT_POINT' => $exeTakenDetail['DETAILS']['POINT'] ?? 0]);

            foreach ($check_type as $key =>  $type1) {
                $array_total_type[] = $key;
            }
            $array_total_type_list = (count($array_total_type) - 1);
            if($status_type <= $array_total_type_list)
            {
                foreach ($check_type as $key =>  $type0) {

                    $array_type[] = $key;
                    if($status_type == $key+1) {
                        $list_exercise_type_7 = $check_type[$status_type];
                        $list_exercise_type_prev = count($check_type[$status_type - 1]["INFO"]);
                        foreach ($list_exercise_type_7["INFO"] as $key => $data)
                        {
                            $array_key[] = $key;
                        }
                        $json_array = json_encode($array_key);
                        $count_status_url = count($array_key);
                        $array_type_json = json_encode($array_type);
                        if($request->status <= $count_status_url)
                        {
                            if($check_type[$status_type]["KIEU"] == 6)
                            {
                                return view('formatExercise.form_2' ,  compact('list_exercise_type_7' , 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'list_exercise_type_prev' ,'array_total_type_list'));
                            }elseif ($check_type[$status_type]["KIEU"] == 11)
                            {
                                return view('exercise-type.type23' , compact('list_exercise_type_7' , 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrBackgrounds' ,'arrKeys' ,'list_exercise_type_prev' ,'array_total_type_list'));
                            }elseif ($check_type[$status_type]['KIEU'] == 3)
                            {
                                return view('formatExercise.form_exam_2' , compact('list_exercise_type_7' , 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'list_exercise_type_prev' ,'array_total_type_list'));
                            }elseif ($check_type[$status_type]['KIEU'] == 7)
                            {
                                return view('formatExercise.form_one' , compact('list_exercise_type_7' , 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'list_exercise_type_prev' ,'array_total_type_list'));
                            }elseif ($check_type[$status_type]['KIEU'] == 1){
                                return view('formatExercise.type_1' , compact('list_exercise_type_7' , 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'list_exercise_type_prev' ,'array_total_type_list'));
                            }elseif ($check_type[$status_type]['KIEU'] == 2)
                            {
                                return view('formatExercise.form_exam_2' , compact('list_exercise_type_7' , 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'list_exercise_type_prev' ,'array_total_type_list'));
                            }elseif ($check_type[$status_type]['KIEU'] == 5)
                            {
                                return view('exercise-type.type22' , compact('list_exercise_type_7' , 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrImages' ,'list_exercise_type_prev' ,'array_total_type_list'));
                            }elseif ($check_type[$status_type]['KIEU'] == 4)
                            {
                                $countArray = explode('::', $list_exercise_type_7['INFO'][$status_url-1]['HTML_CONTENT']);
                                if(count($countArray) == 6) {
                                    return view('exercise-type.type21' , compact('list_exercise_type_7' , 'arrBackgrounds1', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrBackgrounds' ,'arrKeys','array_total_type_list' ,'list_exercise_type_prev'));
                                } elseif (count($countArray) == 5) {
                                    return view('exercise-type.type215' , compact('list_exercise_type_7' , 'arrBackgrounds1', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrBackgrounds' ,'arrKeys' ,'array_total_type_list' ,'list_exercise_type_prev'));
                                } elseif (count($countArray) == 4) {
                                    return view('exercise-type.type214' , compact('list_exercise_type_7' , 'arrBackgrounds1', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrBackgrounds' ,'arrKeys' ,'array_total_type_list' ,'list_exercise_type_prev'));
                                } elseif (count($countArray) == 3) {
                                    return view('exercise-type.type213' , compact('list_exercise_type_7' , 'arrBackgrounds1', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrBackgrounds' ,'arrKeys' ,'array_total_type_list' ,'list_exercise_type_prev'));
                                }
                            } elseif($check_type[$status_type]["KIEU"] == 10) {
                                return view('formatExercise.form_baby' , compact('list_exercise_type_7' , 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'array_total_type_list' ,'list_exercise_type_prev'));
                            }elseif ($check_type[$status_type]["KIEU"] == 9)
                            {
                                return view('formatExercise.type_1_audio' , compact('list_exercise_type_7' , 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'list_exercise_type_prev' ,'array_total_type_list'));
                            }
                        }else
                        {
                            return redirect()->route('dashboard');
                        }
                    }
                }

                //            exe
                $list_exercise_type_7 = $check_type[0] ?? [];
                $list_exercise_type_prev = 0;
                foreach ($check_type as $key => $type) {
                    foreach ($list_exercise_type_7["INFO"] as $key => $info_7) {
                        $list_stt[] = $key +1;
                    }

                    $json_array = json_encode($list_stt);
                    $array_type_json = json_encode($array_type);

                    if($type['KIEU'] == 7) {
                        return view('formatExercise.form_one' , compact('list_exercise_type_7' , 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'array_total_type_list' ,'list_exercise_type_prev'));

                    } elseif ($type['KIEU'] == 6) {

                        return view('formatExercise.form_2' ,  compact('list_exercise_type_7' , 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'array_total_type_list' ,'list_exercise_type_prev'));
                    } elseif ($type['KIEU'] == 1) {
                        return view('formatExercise.type_1' ,compact('list_exercise_type_7' , 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'array_total_type_list' ,'list_exercise_type_prev'));
                    } elseif ($type['KIEU'] == 3) {
                        return view('formatExercise.form_exam_2' ,compact('list_exercise_type_7' , 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'array_total_type_list' ,'list_exercise_type_prev'));
//                     kieu con sau
                    } elseif ($type['KIEU'] == 2) {
                        return view('formatExercise.form_exam_2' ,compact('list_exercise_type_7' , 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'array_total_type_list', 'list_exercise_type_prev'));
//                     NOOIS CHU
                    } elseif ($type['KIEU'] == 11) {
                        return view('exercise-type.type23' ,compact('list_exercise_type_7' , 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrBackgrounds' ,'arrKeys' ,'array_total_type_list' ,'list_exercise_type_prev'));
                    } elseif ($type['KIEU'] == 5) {
                        return view('exercise-type.type22' ,compact('list_exercise_type_7' , 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrImages' ,'array_total_type_list' ,'list_exercise_type_prev'));
                    } elseif($check_type[$status_type]['KIEU'] == 9) {
                        return view('formatExercise.type_1_audio' ,compact('list_exercise_type_7' , 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'array_total_type_list' ,'list_exercise_type_prev'));
                    } elseif($check_type[$status_type]['KIEU'] == 4) {
                        $countArray = explode('::', $list_exercise_type_7['INFO'][$status_url-1]['HTML_CONTENT']);
                        if(count($countArray) == 6) {
                            return view('exercise-type.type21' , compact('list_exercise_type_7' , 'arrBackgrounds1', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrBackgrounds' ,'arrKeys' ,'array_total_type_list' ,'list_exercise_type_prev'));
                        } elseif (count($countArray) == 5) {
                            return view('exercise-type.type215' , compact('list_exercise_type_7' , 'arrBackgrounds1', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrBackgrounds' ,'arrKeys' ,'array_total_type_list' ,'list_exercise_type_prev'));
                        } elseif (count($countArray) == 4) {
                            return view('exercise-type.type214' , compact('list_exercise_type_7' , 'arrBackgrounds1', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrBackgrounds' ,'arrKeys' ,'array_total_type_list' ,'list_exercise_type_prev'));
                        } elseif (count($countArray) == 3) {
                            return view('exercise-type.type213' , compact('list_exercise_type_7' , 'arrBackgrounds1', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrBackgrounds' ,'arrKeys' ,'array_total_type_list' ,'list_exercise_type_prev'));
                        }
                        //Exercise 2181 lop 3 de nghe 1 vaf animal set 1
                    } elseif($check_type[$status_type]["KIEU"] == 10) {
                        return $list_exercise_type_7;
                        return view('formatExercise.form_baby' , compact('list_exercise_type_7' , 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'array_total_type_list' ,'list_exercise_type_prev'));
                    }
                }
            } else {
                return redirect()->route('dashboard');
            }

        } catch(\Exception $e) {
            return redirect()->route('exercise-done')->with('_error_message', $e->getMessage());
        }
        return view('exercise.exercise_taken_detail', [
            'takenDetail' => $exeTakenDetail['DETAILS']
        ]);
    }

    public function listExampleTest(Request $request)
    {
        $listTest = [];
        try {
            $response = Http::withToken(session('USER_TOKEN'))->asForm()->post(HomeHelper::DOMAIN . '/kit/get_list', [
                'USER_MOTHER' => session('USER_INFO')['PARENT_USERNAME'],
                'USER_CHILD'  => session('USER_INFO')['USERNAME'],
            ]);
            $response = $response->json();

            if($response['ERROR'] === '0000') {
                $listTest = $response['INFO'];
            } else {
                return redirect()->route('dashboard')->with('_error_message', $response['RESULT']);
            }
        } catch(\Exception $e) {
            return redirect()->route('dashboard')->with('_error_message', $e->getMessage());
        }

        return view('dashboard.list_example_test', [
            'listTest'  => $listTest,
            'userMom'   => session('USER_INFO')['PARENT_USERNAME'],
            'userChild' => session('USER_INFO')['USERNAME'],
            'userToken' => session('USER_TOKEN')
        ]);
    }

    public function kitActive(Request $request)
    {
        $kitId = (int)$request->id;
        $codeActive = $request->code;
        if(! $kitId || ! $codeActive) {
            return response()->json(['ERROR' => '0001', 'RESULT' => 'Có lỗi xảy ra khi kích hoạt']);
        }

        try {
            $response = Http::withToken(session('USER_TOKEN'))->asForm()->post(HomeHelper::DOMAIN . '/kit/active', [
                'USER_MOTHER' => session('USER_INFO')['PARENT_USERNAME'],
                'USER_CHILD'  => session('USER_INFO')['USERNAME'],
                'KIT_ID'      => $kitId,
                'ACTIVE_CODE' => $codeActive
            ]);

            session(['EXAMPLE_DETAILS_NAME' => $response->name]);
        } catch(\Exception $e) {
            return response()->json(['ERROR' => '0001', 'RESULT' => $e->getMessage()]);
        }

        return response()->json($response->json());
    }

    public function actionStartTaken(Request $request)
    {
        $exercise = json_decode($request->get('input_start_taken'), true);
        if(!isset($exercise["PARTS"]) || ! isset($exercise['DURATION'])) {
            return redirect()->route('example_test')->with('_error_message', 'Có lỗi xảy ra trong khi bắt đầu làm bài');
        }

        session(['DETAIL_EXERCISE' => $exercise["PARTS"]]);
        session(['CURRENT_POINT' => 0.0]);

        session(['TIME_START' => Date::now()]);

        $arrayPrams1 = [
            "USER_MOTHER"  => session("USER_INFO")["PARENT_USERNAME"],
            "USER_CHILD"   => session("USER_INFO")["USERNAME"],
            "ID_EXCERCISE" => session('CURRENT_WEEK_TEST_ID'),
            "START_TIME" => session('TIME_START'),
            "DURATION" => 3600
        ];

        $response1 = $this->callPostApiBase(session('USER_TOKEN'), '/start_taken', $arrayPrams1);
        $result =  $response1->json();
        if($result["ERROR"] == "0000")
        {
            $checkType = session('DETAIL_EXERCISE');
            if(count($checkType)) {
                for ($i = 0; $i < count($checkType); $i++) {
                    if(count($checkType[$i]['INFO'])) {
                        for ($j = 0; $j < count($checkType[$i]['INFO']); $j++) {
                            if(!isset($checkType[$i]['INFO'][$j]['RESULT_CHILD'])) {
                                $checkType[$i]['INFO'][$j]['RESULT_CHILD'] = "";
                            }
                        }
                    }
                }
            }

            session(['DETAIL_EXERCISE' => $checkType]);
            session(['EXCERCISE_ID_TEST' => session('DETAIL_EXERCISE')[0]["EXCERCISE_ID"]]);


            session(['CURRENT_WEEK_TEST_ID' => $exercise['WEEK_TEST_ID'], 'CURRENT_TEST_TEXT' => HomeHelper::EXAMPLE_TEST]);
        }

        try {
            return redirect()->route('exercise_test_task', ['id' => $exercise['WEEK_TEST_ID']]);
        } catch (\Exception $e) {
            return redirect()->route('example_test')->with('_error_message', $e->getMessage());
        }
    }

    public function exerciseTestTask(Request $request, $id)
    {
        $arrImages = ['/images/type22_1.png', '/images/type22_2.png', '/images/type22_3.png', '/images/type22_4.png'];
        $arrBackgrounds = ['#F2C94C', '#6FCF97', '#56CCF2', '#FF6551'];
        $arrKeys = ['#D4B208', '#069306', '#1191DB', '#DB1C39'];
        $arrBackgrounds1 = ['#F2994A', '#F2C94C', '#6FCF97', '#56CCF2', '#D493ED', '#FF6551'];
        $status_url = 1;
        $status_type =0;

        if($request->status)
        {
            $status_url = $request->status;
        }

        if($request->type)
        {
            $status_type = $request->type;
        }


        try {
            $check_type = session('DETAIL_EXERCISE');
            foreach ($check_type as $key =>  $type1) {
                $array_total_type[] = $key;
            }
            $array_total_type_list = (count($array_total_type) - 1);
            if($status_type <= $array_total_type_list)
            {
                $kieu10 = $check_type[$status_type - 1]['KIEU'] ?? '';
                foreach ($check_type as $key =>  $type0) {

                    $array_type[] = $key;
                    if($status_type == $key+1) {
                        $list_exercise_type_7 = $check_type[$status_type];
                        $list_exercise_type_prev = count($check_type[$status_type - 1]["INFO"]);
                        foreach ($list_exercise_type_7["INFO"] as $key => $data)
                        {
                            $array_key[] = $key;
                        }
                        $json_array = json_encode($array_key);
                        $array_type_json = json_encode($array_type);
                        if($check_type[$status_type]["KIEU"] == 6)
                        {
                            return view('formatExercise.form_2' ,  compact('list_exercise_type_7' , 'kieu10', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'list_exercise_type_prev' ,'array_total_type_list'));
                        }elseif ($check_type[$status_type]["KIEU"] == 11)
                        {
                            return view('exercise-type.type23' , compact('list_exercise_type_7' , 'kieu10', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrBackgrounds' ,'arrKeys' ,'list_exercise_type_prev' ,'array_total_type_list'));
                        }elseif ($check_type[$status_type]['KIEU'] == 3)
                        {
                            return view('formatExercise.form_exam_2' , compact('list_exercise_type_7' , 'kieu10', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'list_exercise_type_prev' ,'array_total_type_list'));
                        }elseif ($check_type[$status_type]['KIEU'] == 7)
                        {
                            return view('formatExercise.form_one' , compact('list_exercise_type_7' , 'kieu10', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'list_exercise_type_prev' ,'array_total_type_list'));
                        }elseif ($check_type[$status_type]['KIEU'] == 1){
                            return view('formatExercise.type_1' , compact('list_exercise_type_7' , 'kieu10', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'list_exercise_type_prev' ,'array_total_type_list'));
                        }elseif ($check_type[$status_type]['KIEU'] == 2)
                        {
                            return view('formatExercise.form_exam_2' , compact('list_exercise_type_7' , 'kieu10', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'list_exercise_type_prev' ,'array_total_type_list'));
                        }elseif ($check_type[$status_type]['KIEU'] == 5)
                        {
                            return view('exercise-type.type22' , compact('list_exercise_type_7' , 'kieu10', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrImages' ,'list_exercise_type_prev' ,'array_total_type_list'));
                        }elseif ($check_type[$status_type]['KIEU'] == 4)
                        {
                            $countArray = explode('::', $list_exercise_type_7['INFO'][$status_url-1]['HTML_CONTENT']);
                            if(count($countArray) == 6) {
                                return view('exercise-type.type21' , compact('list_exercise_type_7' , 'kieu10', 'arrBackgrounds1', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrBackgrounds' ,'arrKeys','array_total_type_list' ,'list_exercise_type_prev'));
                            } elseif (count($countArray) == 5) {
                                return view('exercise-type.type215' , compact('list_exercise_type_7' , 'kieu10', 'arrBackgrounds1', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrBackgrounds' ,'arrKeys' ,'array_total_type_list' ,'list_exercise_type_prev'));
                            } elseif (count($countArray) == 4) {
                                return view('exercise-type.type214' , compact('list_exercise_type_7' , 'kieu10', 'arrBackgrounds1', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrBackgrounds' ,'arrKeys' ,'array_total_type_list' ,'list_exercise_type_prev'));
                            } elseif (count($countArray) == 3) {
                                return view('exercise-type.type213' , compact('list_exercise_type_7' , 'kieu10', 'arrBackgrounds1', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrBackgrounds' ,'arrKeys' ,'array_total_type_list' ,'list_exercise_type_prev'));
                            }
                        } elseif($check_type[$status_type]["KIEU"] == 10) {
                            return view('formatExercise.form_baby' , compact('list_exercise_type_7' , 'kieu10', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'array_total_type_list' ,'list_exercise_type_prev'));
                        }elseif ($check_type[$status_type]['KIEU'] == 9)
                        {
                            return view('formatExercise.type_1_audio' , compact('list_exercise_type_7' , 'kieu10', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'list_exercise_type_prev' ,'array_total_type_list'));
                        }
                    }
                }


                //            exe


                $list_exercise_type_7 = session('DETAIL_EXERCISE')[0] ?? [];
                $list_exercise_type_prev = 0;
                foreach ($check_type as $key => $type) {
                    foreach ($list_exercise_type_7["INFO"] as $key => $info_7) {
                        $list_stt[] = $key +1;
                    }

                    $json_array = json_encode($list_stt);
                    $array_type_json = json_encode($array_type);

                    if($type['KIEU'] == 7) {
                        return view('formatExercise.form_one' , compact('list_exercise_type_7' , 'kieu10', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'array_total_type_list' ,'list_exercise_type_prev'));

                    } elseif ($type['KIEU'] == 6) {

                        return view('formatExercise.form_2' ,  compact('list_exercise_type_7' , 'kieu10', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'array_total_type_list' ,'list_exercise_type_prev'));
                    } elseif ($type['KIEU'] == 1) {
                        return view('formatExercise.type_1' ,compact('list_exercise_type_7' , 'kieu10', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'array_total_type_list' ,'list_exercise_type_prev'));
                    } elseif ($type['KIEU'] == 3) {
                        return view('formatExercise.form_exam_2' ,compact('list_exercise_type_7' , 'kieu10', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'array_total_type_list' ,'list_exercise_type_prev'));
//                     kieu con sau
                    } elseif ($type['KIEU'] == 2) {
                        return view('formatExercise.form_exam_2' ,compact('list_exercise_type_7' , 'kieu10', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'array_total_type_list' ,'list_exercise_type_prev'));
//                     NOOIS CHU
                    } elseif ($type['KIEU'] == 11) {
                        return view('exercise-type.type23' ,compact('list_exercise_type_7' , 'kieu10', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrBackgrounds' ,'arrKeys' ,'array_total_type_list' ,'list_exercise_type_prev'));
                    } elseif ($type['KIEU'] == 5) {
                        return view('exercise-type.type22' ,compact('list_exercise_type_7' , 'kieu10', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrImages' ,'array_total_type_list' ,'list_exercise_type_prev'));
                    } elseif($check_type[$status_type]['KIEU'] == 9) {
                        return view('formatExercise.type_1_audio' ,compact('list_exercise_type_7' , 'kieu10', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'array_total_type_list' ,'list_exercise_type_prev'));
                    } elseif($check_type[$status_type]['KIEU'] == 4) {
                        $countArray = explode('::', $list_exercise_type_7['INFO'][$status_url-1]['HTML_CONTENT']);
                        if(count($countArray) == 6) {
                            return view('exercise-type.type21' , compact('list_exercise_type_7' , 'kieu10', 'arrBackgrounds1', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrBackgrounds' ,'arrKeys' ,'array_total_type_list' ,'list_exercise_type_prev'));
                        } elseif (count($countArray) == 5) {
                            return view('exercise-type.type215' , compact('list_exercise_type_7' , 'kieu10', 'arrBackgrounds1', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrBackgrounds' ,'arrKeys' ,'array_total_type_list' ,'list_exercise_type_prev'));
                        } elseif (count($countArray) == 4) {
                            return view('exercise-type.type214' , compact('list_exercise_type_7' , 'kieu10', 'arrBackgrounds1', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrBackgrounds' ,'arrKeys' ,'array_total_type_list' ,'list_exercise_type_prev'));
                        } elseif (count($countArray) == 3) {
                            return view('exercise-type.type213' , compact('list_exercise_type_7' , 'kieu10', 'arrBackgrounds1', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'arrBackgrounds' ,'arrKeys' ,'array_total_type_list' ,'list_exercise_type_prev'));
                        }
                        //Exercise 2181 lop 3 de nghe 1 vaf animal set 1
                    } elseif($check_type[$status_type]["KIEU"] == 10) {
                        return view('formatExercise.form_baby' , compact('list_exercise_type_7' , 'kieu10', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'array_total_type_list' ,'list_exercise_type_prev'));
                    }
                }

            } else {
                return redirect()->route('dashboard');
            }


        } catch (Exception $e) {
            return redirect()->route('dashboard')->with('_error_message', $e->getMessage());
        }
    }

    public function listExampleDetails(Request $request)
    {
        $exerciseId   = $request->get('id');
        $exerciseList = $request->get('ex_lst');
        if(! $exerciseId || ! $exerciseList) {
            return redirect()->route('example_test')->with('_error_message', 'Đường dẫn không đúng vui lòng truy cập lại');
        }

        try {
            $response = Http::withToken(session('USER_TOKEN'))->asForm()->post(HomeHelper::DOMAIN . '/kit/get_list_detail', [
                'USER_MOTHER' => session('USER_INFO')['PARENT_USERNAME'],
                'USER_CHILD'  => session('USER_INFO')['USERNAME'],
                'KIT_ID'      => $exerciseId,
                'EXCERCISE_LIST' => $exerciseList
            ]);

            $response = $response->json();
            if(session('LIST_DETAIL_TEST'))
            {
                if(session('LIST_DETAIL_TEST')["INFO"][0]["WEEK_TEST_ID"] != $response["INFO"][0]["WEEK_TEST_ID"])
                {
                    session(['LIST_DETAIL_TEST' => $response]);
                }
            }else
            {
                session(['LIST_DETAIL_TEST' => $response]);
            }
            if($response['ERROR'] !== '0000') {
                 return redirect()->route('example_test')->with('_error_message', $response['RESULT']);
            }
        } catch(\Exception $e) {
            return redirect()->route('example_test')->with('_error_message', $e->getMessage());
        }

        return view('dashboard.example_detail', [
            'details'     => session('LIST_DETAIL_TEST')['INFO'],
            'exampleName' => $request->get('name') ? $request->get('name') : session('EXAMPLE_DETAILS_NAME')
        ]);
    }

    private function loginApi($parentUser, $childUser, $childPassword)
    {
        $response = Http::asForm()->post(HomeHelper::DOMAIN . '/login_child', [
                    'USER_MOTHER' => $parentUser,
                    'USER_CHILD'  => $childUser,
                    'PASSWORD'    => $childPassword
                ]);

        return $response->json();
    }
}
