<div>
    <style>
        /* CSS for table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #dddddd;
        }

        /* Additional CSS for responsiveness */
        @media only screen and (max-width: 600px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                border: 1px solid #dddddd;
            }

            td {
                border: none;
                border-bottom: 1px solid #dddddd;
                position: relative;
                padding-left: 50%;
            }

            td:before {
                position: absolute;
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
            }

            td:nth-of-type(1):before { content: "College"; }
            td:nth-of-type(2):before { content: "Batch"; }
            td:nth-of-type(3):before { content: "Department"; }
            td:nth-of-type(4):before { content: "Section"; }
            td:nth-of-type(5):before { content: "Course"; }
        }
    </style>

    @if($courseSelections->isNotEmpty())
        <h2>Your Course Selections</h2>
        <table>
            <thead>
                <tr>
                    <th>College</th>
                    <th>Batch</th>
                    <th>Department</th>
                    <th>Section</th>
                    <th>Course</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courseSelections as $selection)
                    <tr>
                        <td>{{ $selection->college->name }}</td>
                        <td>{{ $selection->batch->name }}</td>
                        <td>{{ $selection->department->name }}</td>
                        <td>{{ $selection->section->name }}</td>
                        <td>{{ $selection->course->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No course selections found for you.</p>
    @endif
</div>
