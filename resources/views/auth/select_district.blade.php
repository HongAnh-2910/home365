
@if(isset($list_district["INFO"]))
<select class="form-control  item__form-profile" name="district" id="form__qh">
    <option selected="selected" hidden ="hidden">Chọn quận/ huyện</option>
    @foreach($list_district["INFO"] as $district)
    <option value="{{ $district["ID"] }}">{{ $district["DISTRICT_NAME"] }}</option>
    @endforeach
    @endif
</select>
