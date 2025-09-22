<div class="input-group input-group-sm">
  <div class="input-group-prepend">
    <div class="input-group-text">
      <i class="fas fa-list"></i>
    </div>
  </div>
  <select name="row_per_page" id="{{ $id }}" class="form-control {{ $class ?? '' }}">
    <option>10</option>
    <option>25</option>
    <option>50</option>
    <option>100</option>
  </select>
</div>
