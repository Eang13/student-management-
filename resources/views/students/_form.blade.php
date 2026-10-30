@php $s = $student ?? null; @endphp
@csrf
<div class="section-title">Personal information</div>
<div class="field">
    <label>Student name</label>
    <input class="input @error('student_name') has-error @enderror" type="text" name="student_name" value="{{ old('student_name', $s?->student_name) }}">
    @error('student_name') <div class="err">{{ $message }}</div> @enderror
</div>
<div class="row2">
    <div class="field">
        <label>Email address</label>
        <input class="input @error('email') has-error @enderror" type="email" name="email" value="{{ old('email', $s?->email) }}">
        @error('email') <div class="err">{{ $message }}</div> @enderror
    </div>
    <div class="field">
        <label>Gender</label>
        <select name="gender" class="@error('gender') has-error @enderror">
            <option value="">-- Select --</option>
            @foreach (['Male', 'Female'] as $g)
                <option value="{{ $g }}" @selected(old('gender', $s?->gender) === $g)>{{ $g }}</option>
            @endforeach
        </select>
        @error('gender') <div class="err">{{ $message }}</div> @enderror
    </div>
</div>

<div class="section-title">Academic information</div>
<div class="row2">
    <div class="field">
        <label>Enrollment date</label>
        <input class="input @error('enrollment_date') has-error @enderror" type="date" name="enrollment_date" value="{{ old('enrollment_date', $s?->enrollment_date?->format('Y-m-d')) }}">
        @error('enrollment_date') <div class="err">{{ $message }}</div> @enderror
    </div>
    <div class="field">
        <label>Department</label>
        <select name="department_id" class="@error('department_id') has-error @enderror">
            <option value="">-- Select department --</option>
            @foreach ($departments as $d)
                <option value="{{ $d->dept_id }}" @selected(old('department_id', $s?->department_id) == $d->dept_id)>{{ $d->dept_name }}</option>
            @endforeach
        </select>
        @error('department_id') <div class="err">{{ $message }}</div> @enderror
    </div>
</div>
<div class="field">
    <label>Additional information</label>
    <textarea name="description" rows="3" placeholder="Enter any additional information about the student">{{ old('description', $s?->description) }}</textarea>
</div>

<div class="actions">
    <button class="btn btn-primary">{{ $submit }}</button>
    <button type="reset" class="btn btn-light">Reset</button>
    <a href="{{ route('students.index') }}" class="btn btn-light">Student list</a>
</div>
