<!-- section-form.blade.php -->
<div>
    <!-- Form to add new section -->
    <form wire:submit.prevent="save" style="margin-bottom: 20px;">
        <input type="text" wire:model="name" placeholder="Enter section name" style="padding: 5px; margin-right: 10px;">
        @error('name') <span style="color: red; font-size: 12px; margin-top: 5px; display: block;">{{ $message }}</span> @enderror
        <button type="submit" style="padding: 5px 10px; background-color: #007bff; color: #fff; border: none; cursor: pointer;">Save</button>
    </form>

    <!-- Display existing sections in a table -->
    <h2>Existing Sections:</h2>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="padding: 8px; border: 1px solid #ddd; background-color: #f2f2f2; text-align: left;">ID</th>
                <th style="padding: 8px; border: 1px solid #ddd; background-color: #f2f2f2; text-align: left;">Name</th>
                <th style="padding: 8px; border: 1px solid #ddd; background-color: #f2f2f2; text-align: left;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sections as $section)
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: left;">{{ $section->id }}</td>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: left;">
                    @if ($editId === $section->id)
                    <input type="text" wire:model="editedName">
                    @else
                    {{ $section->name }}
                    @endif
                </td>
                <td style="padding: 8px; border: 1px solid #ddd; text-align: left;">
                    @if ($editId === $section->id)
                    <button wire:click="update({{ $section->id }})" style="padding: 5px 10px; background-color: #007bff; color: #fff; border: none; cursor: pointer;">Save</button>
                    @else
                    <button wire:click="edit({{ $section->id }})" style="padding: 5px 10px; background-color: #007bff; color: #fff; border: none; cursor: pointer;">Edit</button>
                    <button wire:click="delete({{ $section->id }})" style="padding: 5px 10px; background-color: #007bff; color: #fff; border: none; cursor: pointer;">Delete</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
