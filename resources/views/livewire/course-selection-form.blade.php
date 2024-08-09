<div>
    <label for="college">Select College:</label>
    <select wire:model="selectedCollege" id="college">
        <option value="">Select a College</option>
        @foreach($colleges as $college)
            <option value="{{ $college->id }}">{{ $college->name }}</option>
        @endforeach
    </select>

    <label for="batch">Select Batch:</label>
    <select wire:model="selectedBatch" id="batch">
        <option value="">Select a Batch</option>
        @foreach($batches as $batch)
            <option value="{{ $batch->id }}">{{ $batch->name }}</option>
        @endforeach
    </select>

    <label for="department">Select Department:</label>
    <select wire:model="selectedDepartment" id="department">
        <option value="">Select a Department</option>
        @foreach($departments as $department)
            <option value="{{ $department->id }}">{{ $department->name }}</option>
        @endforeach
    </select>

    <label for="section">Select Section:</label>
    <select wire:model="selectedSection" id="section">
        <option value="">Select a Section</option>
        @foreach($sections as $section)
            <option value="{{ $section->id }}">{{ $section->name }}</option>
        @endforeach
    </select>

    <label for="course">Select Course:</label>
    <select wire:model="selectedCourse" id="course">
        <option value="">Select a Course</option>
        @foreach($courses as $course)
            <option value="{{ $course->id }}">{{ $course->name }}</option>
        @endforeach
    </select>
    

    @if($selectedCollege)
        <p>You selected: {{ $colleges->find($selectedCollege)->name }}</p>
    @endif

    <!-- Existing code for dropdowns -->
<!-- Existing dropdowns -->

<button wire:click="saveSelection">Save</button>

<!-- Display stored data -->
@if($course_selections !== null && $course_selections->isNotEmpty())
    <!-- Display stored data -->
    <h2>Stored Course Selections</h2>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="padding: 8px; border: 1px solid #ddd;">College</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Batch</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Department</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Section</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Course</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Actions</th>

            </tr>
        </thead>
        <tbody>
            @foreach($course_selections as $selection)
                <tr>
                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $selection->college->name }}</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $selection->batch->name }}</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $selection->department->name }}</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $selection->section->name }}</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $selection->course->name }}</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">
                        <button wire:click="deleteSelection({{ $selection->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No course selections found.</p>
@endif
