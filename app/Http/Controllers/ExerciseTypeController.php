<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExerciseTypeController extends Controller
{
    public function actionType21()
    {
        $arrBackgrounds = ['#F2994A', '#F2C94C', '#6FCF97', '#56CCF2', '#D493ED', '#FF6551'];
        return view('exercise-type.type21', [
            'arrBackgrounds' => $arrBackgrounds,
        ]);
    }

    public function logicFormType10(Request $request)
    {
//        session()->forget('STATUS_BABY');
        $status_url  = $request->status_url;
        $status_type = $request->status_type;
        $answered    = $request->answered;
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
                session(['STATUS_BABY' => $request->status_url]);
            } else {
                return json_encode(['message' => 300, 'result' => 'Bài tập đã được chấm điểm rồi, không thể chấm điểm lần nữa.', 'currentPoint' => (string)session('CURRENT_POINT')]);
            }
            return json_encode(['message' => 200, 'result' => 'Chấm điểm thành công', 'currentPoint' => number_format(session('CURRENT_POINT'), 1)]);
        }

        return json_encode(['message' => 404, 'result' => 'Có lỗi xảy ra, chấm điểm không thành công']);
    }

    public function captureTypeOne(Request $request)
    {
        $status_url  = $request->status_url;
        $status_type = $request->status_type;
        $answered    = $request->answered;
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

    public function captureTwentyThird(Request $request)
    {
        $status_url  = $request->status_url;
        $status_type = $request->status_type;
        $answered    = $request->answered;
        $isCorrect = true;
        $checkType = session('DETAIL_EXERCISE');

        if(isset($checkType[$status_type]['INFO'][$status_url-1])) {
            if ( ! $checkType[$status_type]['INFO'][$status_url - 1]['RESULT_CHILD']) {
                if(count($answered)) {
                    foreach ($answered as $key => $item) {
                        if($item != $checkType[$status_type]['INFO'][$status_url - 1][$key]) {
                            $isCorrect = false;
                            $checkType[$status_type]['INFO'][$status_url-1]['is_correct'] = false;
                        }

                        switch ($key) {
                            case 'HTML_A':
                            $checkType[$status_type]['INFO'][$status_url - 1]['EGG_1_RESULT'] = $item;
                            break;

                            case 'HTML_B':
                            $checkType[$status_type]['INFO'][$status_url - 1]['EGG_2_RESULT'] = $item;
                            break;

                            case 'HTML_C':
                            $checkType[$status_type]['INFO'][$status_url - 1]['EGG_3_RESULT'] = $item;
                            break;

                            case 'HTML_D':
                            $checkType[$status_type]['INFO'][$status_url - 1]['EGG_4_RESULT'] = $item;
                            break;
                        }
                    }

                    if($isCorrect) {
                        $checkType[$status_type]['INFO'][$status_url-1]['is_correct'] = true;
                        $checkType[$status_type]['INFO'][$status_url-1]['POINT_CHILD'] = $checkType[$status_type]['INFO'][$status_url-1]['POINT'];
                    }

                    $checkType[$status_type]['INFO'][$status_url-1]['RESULT_CHILD'] = true;
                    session(['CURRENT_POINT' => session('CURRENT_POINT') + (float)$checkType[$status_type]['INFO'][$status_url-1]['POINT_CHILD']]);
                    session(['DETAIL_EXERCISE' => $checkType]);
                }

            } else {
                return json_encode(['message' => 300, 'result' => 'Bài tập đã được chấm điểm rồi, không thể chấm điểm lần nữa.', 'currentPoint' => session('CURRENT_POINT')]);
            }

            return json_encode(['message' => 200, 'correct' => $isCorrect, 'result' => 'Chấm điểm thành công', 'currentPoint' => number_format(session('CURRENT_POINT'), 1)]);
        }

        return json_encode(['message' => 404, 'result' => 'Có lỗi xảy ra, chấm điểm không thành công']);
    }

    public function captureTypeTwenty(Request $request)
    {
        $status_url  = $request->status_url;
        $status_type = $request->status_type;
        $answered    = $request->answered;
        $isCorrect = false;
        $checkType = session('DETAIL_EXERCISE');
        if(isset($checkType[$status_type]['INFO'][$status_url-1])) {
            if ( ! $checkType[$status_type]['INFO'][$status_url - 1]['RESULT_CHILD']) {
                if($answered == $checkType[$status_type]['INFO'][$status_url - 1]['HTML_CONTENT']) {
                    $checkType[$status_type]['INFO'][$status_url-1]['POINT_CHILD'] = $checkType[$status_type]['INFO'][$status_url-1]['POINT'];
                    $isCorrect = true;
                }

                $checkType[$status_type]['INFO'][$status_url-1]['ANSWER_CHILD'] = $answered;

                $checkType[$status_type]['INFO'][$status_url-1]['RESULT_CHILD'] = true;
                session(['CURRENT_POINT' => session('CURRENT_POINT') + (float)$checkType[$status_type]['INFO'][$status_url-1]['POINT_CHILD']]);
                session(['DETAIL_EXERCISE' => $checkType]);
            } else {
                return json_encode(['message' => 300, 'result' => 'Bài tập đã được chấm điểm rồi, không thể chấm điểm lần nữa.', 'currentPoint' => session('CURRENT_POINT')]);
            }

            return json_encode(['message' => 200, 'correct' => $isCorrect, 'result' => 'Chấm điểm thành công', 'currentPoint' => number_format(session('CURRENT_POINT'), 1)]);
        }

        return json_encode(['message' => 404, 'result' => 'Có lỗi xảy ra, chấm điểm không thành công']);
    }

    public function captureTypeTwo(Request $request)
    {
        $status_url  = $request->status_url;
        $status_type = $request->status_type;
        $answered    = $request->answered;
        $checkType = session('DETAIL_EXERCISE');
        $isCorrect = false;

        if(isset($checkType[$status_type]['INFO'][$status_url-1])) {
            if(!$checkType[$status_type]['INFO'][$status_url-1]['RESULT_CHILD']) {
                $originText = $html = $checkType[$status_type]['INFO'][$status_url-1]['HTML_CONTENT'];
                if($answered && count($answered)) {
                    $patern = '/<<(.*?)>>/';
                    $originText = preg_replace_array($patern, $answered, $originText);
                    $originText = str_replace('<<<<', '<<<', $originText);
                    $originText = str_replace('>>>>', '>>>', $originText);
                    $checkType[$status_type]['INFO'][$status_url-1]['ANSWER_CHILD'] = $originText;
                }

                if(strtoupper($html) == strtoupper($originText)) {
                    $checkType[$status_type]['INFO'][$status_url-1]['POINT_CHILD'] = $checkType[$status_type]['INFO'][$status_url-1]['POINT'];
                    $checkType[$status_type]['INFO'][$status_url-1]['ANSWER_CHILD'] = strtoupper($originText);
                    $isCorrect = true;
                }

                $checkType[$status_type]['INFO'][$status_url-1]['RESULT_CHILD'] = true;
                session(['CURRENT_POINT' => session('CURRENT_POINT') + (float)$checkType[$status_type]['INFO'][$status_url-1]['POINT_CHILD']]);
                session(['DETAIL_EXERCISE' => $checkType]);
            } else {
                return json_encode(['message' => 300, 'result' => 'Bài tập đã được chấm điểm rồi, không thể chấm điểm lần nữa.', 'currentPoint' => session('CURRENT_POINT')]);
            }

            return json_encode(['message' => 200, 'correct' => $isCorrect, 'result' => 'Chấm điểm thành công', 'currentPoint' => number_format(session('CURRENT_POINT'), 1)]);
        }

        return json_encode(['message' => 404, 'result' => 'Có lỗi xảy ra, chấm điểm không thành công']);
    }

    public function actionType22()
    {
        $arrImages = ['/images/type22_1.png', '/images/type22_2.png', '/images/type22_3.png', '/images/type22_4.png'];
        return view('exercise-type.type22', [
            'arrImages' => $arrImages
        ]);
    }

    public function actionType23()
    {
        $arrBackgrounds = ['#F2C94C', '#6FCF97', '#56CCF2', '#FF6551'];
        $arrKeys = ['#D4B208', '#069306', '#1191DB', '#DB1C39'];
        return view('exercise-type.type23', [
            'arrBackgrounds' => $arrBackgrounds,
            'arrKeys'        => $arrKeys
        ]);
    }
}
