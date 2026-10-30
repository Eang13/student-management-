@php $d = $department ?? null; @endphp
@csrf
<div class="field">
    <label>Department name</label>
    <input class="input @error('dept_name') has-error @enderror" type="text" name="dept_name" value="{{ old('dept_name', $d?->dept_name) }}">
    @error('dept_name') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="row2">
    <div class="field">
        <label>Manager ID</label>
        <input class="input" type="number" name="manager_id" value="{{ old('manager_id', $d?->manager_id) }}">
        @error('manager_id') <div class="err">{{ $message }}</div> @enderror
    </div>
    <div class="field">
        <label>Location ID</label>
        <input class="input" type="number" name="location_id" value="{{ old('location_id', $d?->location_id) }}">
        @error('location_id') <div class="err">{{ $message }}</div> @enderror
    </div>
</div>
<div class="actions">
    <button class="btn btn-primary">{{ $submit }}</button>
    <a href="{{ route('departments.index') }}" class="btn btn-light">Cancel</a>
</div>
