<?php

namespace App\Http\Controllers;

use App\Helpers\HomeHelper;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SkillController extends BaseController
{
    public function listLessonSkill(Request $request)
    {
        try {
            $response_list_lesson1 = [];
            $response_list_lesson2 = [];
            $response_list_lesson3 = [];
            $response_total        = [];
            $arrayPrams            = [
                'USER_MOTHER' => session('USER_INFO')['PARENT_USERNAME'],
                'USER_CHILD'  => session('USER_INFO')['USERNAME'],
                'ID_DISTRICT' => session("USER_INFO")['LEVEL_ID'] ?? 4,
            ];
            $response              = $this->callPostApiBase(session('USER_TOKEN'), '/get_list_menu_skill', $arrayPrams);
            $list_title_skill      = $response->json()['INFO'] ?? '';
            if ($response['ERROR'] == '0000') {
                $arrayPrams = [
                    'USER_MOTHER' => session('USER_INFO')['PARENT_USERNAME'],
                    'USER_CHILD'  => session('USER_INFO')['USERNAME'],
                    'SKILL_ID'    => $list_title_skill[0]['ID'],
                ];
                $response1  = $this->callPostApiBase(session('USER_TOKEN'), '/get_list_lesson_skill', $arrayPrams);

                $response_list_lesson1 = $response1->json()["INFO"] ?? '';

//                  api 2
                $arrayPrams            = [
                    'USER_MOTHER' => session('USER_INFO')['PARENT_USERNAME'],
                    'USER_CHILD'  => session('USER_INFO')['USERNAME'],
                    'SKILL_ID'    => $list_title_skill[1]['ID'],
                ];
                $response2             = $this->callPostApiBase(session('USER_TOKEN'), '/get_list_lesson_skill',
                    $arrayPrams);
                $response_list_lesson2 = $response2->json()["INFO"] ?? '';

//                api 3
                $arrayPrams            = [
                    'USER_MOTHER' => session('USER_INFO')['PARENT_USERNAME'],
                    'USER_CHILD'  => session('USER_INFO')['USERNAME'],
                    'SKILL_ID'    => $list_title_skill[2]['ID'],
                ];
                $response3             = $this->callPostApiBase(session('USER_TOKEN'), '/get_list_lesson_skill',
                    $arrayPrams);
                $response_list_lesson3 = $response3->json()["INFO"] ?? '';

                $response_total = [$response_list_lesson1, $response_list_lesson2, $response_list_lesson3];
            }
        } catch (Exception $e) {
            return "Lỗi";
        }

        return view('lessonSkill.index', compact('list_title_skill', 'response_total'));
    }

    /**
     * @param Request $request
     *
     * @return string
     */

    public function lessonAjax(Request $request)
    {
        return view('lessonSkill.modal_ajax');
    }

    /**
     * @param Request $request
     *
     * @return Application|Factory|View
     */

    public function lessonAjaxVideo(Request $request)
    {
        $url   = $request->input('url');
        $title = $request->input('title');

        return view('lessonSkill.modal_video', compact('url', 'title'));
    }
}
