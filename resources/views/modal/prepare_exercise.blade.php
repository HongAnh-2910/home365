<!-- Modal -->
<div class="modal fade" id="modal-exercise-active" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{route('exercise_start_taken')}}" method="post">
        @csrf
        <input type="hidden" value="" class="input-start--taken" name="input_start_taken" />
        <input type="hidden" value="" class="input-start--duration" name="input_start_duration" />
        <div class="modal-dialog position-relative">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        @if(request()->get('name'))
                            {{request()->get('name')}}
                        @elseif(session('EXAMPLE_DETAILS_NAME'))
                            {{session('EXAMPLE_DETAILS_NAME')}}
                        @else
                            Luyện Thi
                        @endif
                    </h5>
                    <button type="button" class="btn-close-modal">
                        <img src="{{asset('images/close-button.svg')}}" />
                    </button>
                </div>
                <div class="modal-body">
                    <div class="font-weight-bold mb-3 exercise-grade"></div>
                    <div class="font-weight-bold exercise-duration mb-3"></div>
                    <div class="exercise-requirement"></div>
                </div>
                <div class="modal-footer justify-content-center">
                    <input type="submit" class="btn-exercise--start d-inline-block mr-2" value="Bắt Đầu">
                    <a class="btn-modal-error-close d-inline-block m-0" href="#">Đóng</a>
                </div>
            </div>
        </div>
    </form>

</div>
