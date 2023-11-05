@if(isset($list_school["INFO"]))
    <option selected="selected" name="school" hidden="hidden">Chọn trường</option>
    @foreach($list_school["INFO"] as $list_school)
        <option
            value="{{ $list_school["ID"] }}">{{ $list_school["SCHOOL_NAME"] }}</option>
    @endforeach
@endif
