<div>
    <!-- Form to add new course -->
    <form wire:submit.prevent="save" style="margin-bottom: 20px;">
        <input type="text" wire:model="name" placeholder="Enter course name" style="padding: 5px; margin-right: 10px;">
        @error('name') <span style="color: red; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
        <button type="submit" style="padding: 5px 10px; background-color: #007bff; color: #fff; border: none; cursor: pointer;">Save</button>
    </form>

    
    <h2>Existing Courses:</h2>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="padding: 8px; border: 1px solid #ddd; background-color: #f2f2f2; text-align: left;">ID</th>
                <th style="padding: 8px; border: 1px solid #ddd; background-color: #f2f2f2; text-align: left;">Name</th>
                <th style="padding: 8px; border: 1px solid #ddd; background-color: #f2f2f2; text-align: left;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: left;">{{ $course->id }}</td>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: left;">
                    @if ($editId === $course->id)
                    <input type="text" wire:model="editedName">
                    @else
                    {{ $course->name }}
                    @endif
                </td>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: left;">
                    @if ($editId === $course->id)
                    <button wire:click="update({{ $course->id }})" style="padding: 5px 10px; background-color: #007bff; color: #fff; border: none; cursor: pointer;">Save</button>
                    @else
                    <button wire:click="edit({{ $course->id }})" style="padding: 5px 10px; background-color: #007bff; color: #fff; border: none; cursor: pointer;">Edit</button>
                    <button wire:click="delete({{ $course->id }})" style="padding: 5px 10px; background-color: #007bff; color: #fff; border: none; cursor: pointer;">Delete</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
