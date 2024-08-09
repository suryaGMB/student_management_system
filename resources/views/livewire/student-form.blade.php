<!-- student-form.blade.php -->
<div>
    <select wire:model="selectedCollege" style="margin-bottom: 10px; padding: 5px;">
        <option value="">Select College</option>
        @foreach($colleges as $college)
        <option value="{{ $college->id }}">{{ $college->name }}</option>
        @endforeach
    </select>

    <select wire:model="selectedBatch" style="margin-bottom: 10px; padding: 5px;">
        <option value="">Select Batch</option>
        @foreach($batches as $batch)
        <option value="{{ $batch->id }}">{{ $batch->name }}</option>
        @endforeach
    </select>

    <select wire:model="selectedDepartment" style="margin-bottom: 10px; padding: 5px;">
        <option value="">Select Department</option>
        @foreach($departments as $department)
        <option value="{{ $department->id }}">{{ $department->name }}</option>
        @endforeach
    </select>

    <select wire:model="selectedSection" style="margin-bottom: 10px; padding: 5px;">
        <option value="">Select Section</option>
        @foreach($sections as $section)
        <option value="{{ $section->id }}">{{ $section->name }}</option>
        @endforeach
    </select>
    <form wire:submit.prevent="handleFileUpload" style="margin-bottom: 20px;">
        <input type="file" wire:model="excelFile" style="margin-right: 10px; padding: 5px;">
        @error('excelFile') <span style="color: red; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
        <button type="submit" style="padding: 5px 10px; background-color: #007bff; color: #fff; border: none; cursor: pointer;">Upload Excel</button>
    </form>
    
    <div>
    <h2>Users</h2>
    @if ($users->isNotEmpty())
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="padding: 8px; border: 1px solid #ddd;">Name</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">College</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Batch</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Department</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Section</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Actions</th> <!-- Add Actions column -->

                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    @if($user->college)
                        <tr>
                            <td style="padding: 8px; border: 1px solid #ddd;">{{ $user->name }}</td>
                            <td style="padding: 8px; border: 1px solid #ddd;">{{ $user->college->name }}</td>
                            <td style="padding: 8px; border: 1px solid #ddd;">{{ $user->batch->name }}</td>
                            <td style="padding: 8px; border: 1px solid #ddd;">{{ $user->department->name }}</td>
                            <td style="padding: 8px; border: 1px solid #ddd;">{{ $user->section->name }}</td>
                            <td style="padding: 8px; border: 1px solid #ddd;">
                                <button wire:click="deleteUser({{ $user->id }})">Delete</button> <!-- Add delete button -->
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @else
        <p>No users found.</p>
    @endif

    <!-- Your existing dropdowns and file upload form -->
    <!-- ... -->
</div>


</div>
