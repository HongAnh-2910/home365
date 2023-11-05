<?php

namespace App\Http\Controllers;

use App\Helpers\HomeHelper;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;

class ExerciseController extends BaseController
{
    public function listExercise(Request $request)
    {
        try {
            $arrayPrams    = [
                "USER_MOTHER" => session("USER_INFO")["PARENT_USERNAME"],
                "USER_CHILD"  => session("USER_INFO")["USERNAME"]
            ];
            $response      = $this->callPostApiBase(session('USER_TOKEN'), '/get_excercise_expired', $arrayPrams);
            $list_exercise = $response->json();
            $listArray     = [];
            foreach ($list_exercise["INFO"] as $exercise) {

                $listArray[$exercise["WEEK_ID"]][] = $exercise;

            }
        } catch (Exception $e) {
            return redirect()->route('dashboard')->with('_error_message', $e->getMessage());
        }

        return view('exercise.list_exercise', compact('listArray'));
    }

    /**
     * @param Request $request
     *
     * @return Application|Factory|View|string
     */

    public function weekExercise(Request $request)
    {
        try {
            $arrayPrams           = [
                "USER_MOTHER" => session("USER_INFO")["PARENT_USERNAME"],
                "USER_CHILD"  => session("USER_INFO")["USERNAME"]
            ];
            $response             = $this->callPostApiBase(session('USER_TOKEN'), '/get_excercise_needed', $arrayPrams);
            $list_exercise_needed = $response->json();
            $listArray            = [];
            foreach ($list_exercise_needed["INFO"] as $exercise) {

                $listArray[$exercise["WEEK_ID"]][] = $exercise;

            }

        } catch (Exception $e) {
            return redirect()->route('dashboard')->with('_error_message', $e->getMessage());
        }

        return view('exercise.week_exercise', compact('listArray'));
    }

    /**
     * @param $id
     *
     * @return Application|Factory|View|string
     */

    public function detailWeekExercise($id)
    {
        try {
            $arrayPrams = [
                "USER_MOTHER"  => session("USER_INFO")["PARENT_USERNAME"],
                "USER_CHILD"   => session("USER_INFO")["USERNAME"],
                "ID_EXCERCISE" => $id,
            ];
            $response   = $this->callPostApiBase(session('USER_TOKEN'), '/get_exe_detail', $arrayPrams);

            $detail_exercise = $response->json();
            $detail_exercise_parts =  json_encode($response->json()["DETAILS"]["PARTS"]);

        } catch (Exception $e) {
            return redirect()->route('dashboard')->with('_error_message', $e->getMessage());
        }

        return view('exercise.detail_week_exercise' ,compact('detail_exercise' , 'detail_exercise_parts' , 'id'));
    }

    public function actionStartWeek(Request $request, $id)
    {
        try {
            $arrayPrams = [
                "USER_MOTHER"  => session("USER_INFO")["PARENT_USERNAME"],
                "USER_CHILD"   => session("USER_INFO")["USERNAME"],
                "ID_EXCERCISE" => $id,
            ];

            $response   = $this->callPostApiBase(session('USER_TOKEN'), '/get_exe_detail', $arrayPrams);
            $check_type =  $response->json()["DETAILS"]["PARTS"];
            session(['CURRENT_POINT' => 0.0]);
            session(['TIME_START' => Date::now()]);

            $arrayPrams1 = [
                "USER_MOTHER"  => session("USER_INFO")["PARENT_USERNAME"],
                "USER_CHILD"   => session("USER_INFO")["USERNAME"],
                "ID_EXCERCISE" => $id,
                "START_TIME" => session('TIME_START'),
                "DURATION" => 3600
            ];

            $response1 = $this->callPostApiBase(session('USER_TOKEN'), '/start_taken', $arrayPrams1);
            $result =  $response1->json();
            if($result["ERROR"] == "0000")
            {
                if(count($check_type)) {
                    for ($i = 0; $i < count($check_type); $i++) {
                        if(count($check_type[$i]['INFO'])) {
                            for ($j = 0; $j < count($check_type[$i]['INFO']); $j++) {
                                if(!isset($check_type[$i]['INFO'][$j]['RESULT_CHILD'])) {
                                    $check_type[$i]['INFO'][$j]['RESULT_CHILD'] = "";
                                }
                            }
                        }
                    }
                }

                session(['DETAIL_EXERCISE' => $check_type]);

                session(['CURRENT_WEEK_TEST_ID' => $id, 'CURRENT_TEST_TEXT' => HomeHelper::WEEK_TEST]);
                return redirect()->route('display-exercise', ['id' => $id]);
            }
//            session(['DETAIL_EXERCISE' => $check_type]);

        } catch(\Exception $e) {
            return redirect()->route('dashboard')->with('_error_message', $e->getMessage());
        }

    }


    public function displayExercise(Request $request ,$id)
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
                        $count_status_url = count($array_key);
                        $array_type_json = json_encode($array_type);
                        if($request->status <= $count_status_url)
                        {
                            if($check_type[$status_type]["KIEU"] == 6)
                            {
                                return view('formatExercise.form_2', compact('list_exercise_type_7' , 'kieu10', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'list_exercise_type_prev' ,'array_total_type_list'));
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
                            }elseif ($check_type[$status_type]["KIEU"] == 9)
                            {
                                return view('formatExercise.type_1_audio' , compact('list_exercise_type_7' , 'kieu10', 'json_array' ,'id' ,'status_url' ,'array_type_json' ,'status_type' ,'list_exercise_type_prev' ,'array_total_type_list'));
                            }
                        } else {
                            return redirect()->route('dashboard');
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
            }else
            {
                return redirect()->route('dashboard');
            }



        } catch (Exception $e) {
            return redirect()->route('dashboard')->with('_error_message', $e->getMessage());
        }

    }

    /**
     * @param Request $request
     *
     * @return Application|Factory|View|string
     */

    public function exerciseDone(Request $request)
    {
        try {
            $arrayPrams         = [
                "USER_MOTHER" => session("USER_INFO")["PARENT_USERNAME"],
                "USER_CHILD"  => session("USER_INFO")["USERNAME"]
            ];
            $response           = $this->callPostApiBase(session('USER_TOKEN'), '/get_excercise_taken', $arrayPrams);
            $list_exercise_done = $response->json();
            $listArray          = [];
            foreach ($list_exercise_done["DETAILS"] as $exercise) {
                $listArray[$exercise["SUBJECT_NAME"]][] = $exercise;
                if(! array_key_exists('Môn Toán', $listArray))
                {
                    $listArray["Môn Toán"] = [] ;
                }else
                {
                     $listArray = $listArray;
                }
                if(! array_key_exists('Môn Tiếng Việt', $listArray))
                {
                    $listArray["Môn Tiếng Việt"] = [] ;
                }else
                {
                    $listArray = $listArray;
                }
                if(! array_key_exists('Môn Tiếng Anh', $listArray))
                {
                    $listArray["Môn Tiếng Anh"] = [] ;
                }else
                {
                    $listArray = $listArray;
                }
            }

        } catch (Exception $e) {
            return redirect()->route('dashboard')->with('_error_message', $e->getMessage());
        }

        return view('exercise.exercises_done', compact('listArray'));
    }

    /**
     * @param Request $request
     */

    public function submitHomework(Request $request)
    {
        $list_detail_exercise = session('LIST_DETAIL_TEST');
        $start_date = date_format(session('TIME_START'), 'd/m/Y H:i:s');
        $now_date = date_format(Date::now(), 'd/m/Y H:i:s');
        $id_exercise = $request->id;
        try {

            $arrayPrams = [
                "USER_MOTHER" => session("USER_INFO")["PARENT_USERNAME"],
                "USER_CHILD"  => session("USER_INFO")["USERNAME"],
                "ID_EXCERCISE" => $id_exercise,
                "DELIVERY_TIME" => '',
                "START_TAKE_TIME" => $start_date,
                "END_TAKE_TIME" => $now_date,
                "DURATION" => (string)number_format((time()- strtotime(session('TIME_START')))/60),
                "SUBMIT_TYPE" => "1",
                "POINT" => (string) session('CURRENT_POINT'),
                "DETAIL" => json_encode(session('DETAIL_EXERCISE'))
            ];

            $response   = $this->callPostApiBase(session('USER_TOKEN'), '/submit_execercise', $arrayPrams);
            $result =  $response->json();
            if($result["ERROR"] == "0000") {
                if(session('EXCERCISE_ID_TEST'))
                {
                    foreach ($list_detail_exercise["INFO"] as $key => $value)
                    {
                        if($value["EXCERCISE_ID"] == session('EXCERCISE_ID_TEST'))
                        {
                            $list_detail_exercise["INFO"][$key]["POINT"] = session('CURRENT_POINT');
                        }
                    }
                    session(['LIST_DETAIL_TEST' => $list_detail_exercise]);
                }
                session()->forget('DETAIL_EXERCISE');
                session()->forget('CURRENT_WEEK_TEST_ID');
                session()->forget('STATUS_BABY');
                return json_encode(['currentPoint' => session('CURRENT_POINT'), 'timeEndExercise' => number_format((time()- strtotime(session('TIME_START')))/60) ,  'message' => 200]);
            }
        }catch (Exception $e)
        {
                return json_encode(['currentPoint' => session('CURRENT_POINT'), 'message' => 404]);
        }
    }

    /**
     * @param Request $request
     */

    public function captureExam3(Request $request)
    {
        $status_url  = $request->status_url;
        $status_type = $request->status_type;
        $answered    = $request->get_value;
        $checkType = session('DETAIL_EXERCISE');
        if(isset($checkType[$status_type]['INFO'][$status_url-1])) {
            if(!$checkType[$status_type]['INFO'][$status_url-1]['RESULT_CHILD']) {
                if($answered) {
                    $checkType[$status_type]['INFO'][$status_url-1]['ANSWER_CHILD'] = $answered;
                    if($answered == $checkType[$status_type]['INFO'][$status_url-1]['ANSWER']) {
                        $checkType[$status_type]['INFO'][$status_url-1]['POINT_CHILD'] = $checkType[$status_type]['INFO'][$status_url-1]['POINT'];
                    }
                }

                $checkType[$status_type]['INFO'][$status_url-1]['RESULT_CHILD'] = true;
                session(['CURRENT_POINT' => session('CURRENT_POINT') + (float)$checkType[$status_type]['INFO'][$status_url-1]['POINT_CHILD']]);
                session(['DETAIL_EXERCISE' => $checkType]);
            } else {
                return json_encode(['message' => 300, 'result' => 'Bài tập đã được chấm điểm rồi, không thể chấm điểm lần nữa.', 'currentPoint' => (string)session('CURRENT_POINT')]);
            }

            return json_encode(['message' => 200, 'result' => 'Chấm điểm thành công', 'currentPoint' => number_format(session('CURRENT_POINT'), 1)]);
        }

        return json_encode(['message' => 404, 'result' => 'Có lỗi xảy ra, chấm điểm không thành công']);

    }

    /**
     * @return Application|Factory|View
     */

    public function exerciseOne(Request $request)
    {
        return view('formatExercise.form_one');
    }

    public function exercise2(Request $request)
    {
        return view('formatExercise.form_2');
    }

    public function exercise3(Request $request)
    {
        return view('formatExercise.form_baby');
    }

    public function exercise4(Request $request)
    {
        return view('formatExercise.form_exam_one');
    }

    public function exercise5(Request $request)
    {
        return view('formatExercise.form_exam_2');
    }

    public function exercise6(Request $request)
    {
        return view('formatExercise.form_exam_3');
    }


}
