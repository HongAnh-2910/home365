<div class="modal fade" id="modal-continue-task" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{route('exercise_start_taken')}}" method="post">
        @csrf
        <input type="hidden" value="" class="input-start--taken" name="input_start_taken" />
        <input type="hidden" value="" class="input-start--duration" name="input_start_duration" />
        <div class="modal-dialog position-relative">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cảnh báo</h5>
                    <button type="button" class="btn-close-modal">
                        <img src="{{asset('images/close-button.svg')}}" />
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Có bài tập đang làm bạn có muốn làm tiếp không?</p>
                </div>
                <div class="modal-footer">
                    @if(session('CURRENT_WEEK_TEST_ID'))
                    <a class="btn-modal-error-close1 d-inline-block m-0"
                       href="{{session('CURRENT_TEST_TEXT') == \App\Helpers\HomeHelper::EXAMPLE_TEST ? route('exercise_test_task', ['id' => session('CURRENT_WEEK_TEST_ID')]) : route('display-exercise', ['id' => session('CURRENT_WEEK_TEST_ID')])}}">Làm tiếp</a>
                    @else
                        <a class="btn-modal-error-close1 d-inline-block m-0" href="#">Làm tiếp</a>
                    @endif
                    <input type="submit" class="btn-exercise--newstart d-inline-block mr-2" value="Làm bài mới">
                </div>
            </div>
        </div>
    </form>
</div>
