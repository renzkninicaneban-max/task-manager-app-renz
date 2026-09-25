<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f0e6;
            color: #26352b;
        }

        .navbar {
            background: #234d35;
            color: white;
            padding: 24px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            margin: 0;
            font-size: 26px;
        }

        .navbar span {
            font-size: 14px;
            color: #f3c66b;
        }

        .container {
            width: 84%;
            max-width: 1100px;
            margin: 40px auto;
        }

        .top-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        .top-section h2 {
            margin: 0;
            color: #234d35;
            font-size: 28px;
        }

        .add-button {
            background: #e58b2a;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: bold;
        }

        .add-button:hover {
            background: #c8751e;
        }

        .success {
            background: #e1efdf;
            color: #285d36;
            padding: 13px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .task-card {
            background: #fffdf7;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 20px;
            border-top: 5px solid #e58b2a;
            box-shadow: 0 4px 14px rgba(35, 77, 53, 0.10);
        }

        .task-card h3 {
            margin-top: 0;
            color: #234d35;
            font-size: 21px;
        }

        .description {
            color: #625f58;
            line-height: 1.6;
        }

        .info {
            margin-top: 15px;
        }

        .status {
            display: inline-block;
            padding: 6px 13px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .pending {
            background: #f8dfad;
            color: #795600;
        }

        .completed {
            background: #dcefd5;
            color: #356b2d;
        }

        .actions {
            margin-top: 20px;
        }

        .actions form {
            display: inline;
        }

        .button {
            border: none;
            padding: 9px 15px;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            margin-right: 5px;
        }

        .status-button {
            background: #f0c45b;
            color: #403300;
        }

        .edit-button {
            background: #234d35;
            color: white;
        }

        .delete-button {
            background: #c65353;
            color: white;
        }

        .empty {
            background: #fffdf7;
            text-align: center;
            padding: 60px 20px;
            border-radius: 12px;
            box-shadow: 0 4px 14px rgba(35, 77, 53, 0.08);
        }

        .empty h3 {
            color: #234d35;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h1>Task Manager</h1>
        <span>Stay organized. Stay productive.</span>
    </div>

    <div class="container">

        <div class="top-section">
            <h2>My Tasks</h2>

            <a href="{{ route('tasks.create') }}" class="add-button">
                + Add Task
            </a>
        </div>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @forelse($tasks as $task)

            <div class="task-card">

                <h3>{{ $task->task_name }}</h3>

                <p class="description">
                    {{ $task->description ?: 'No description provided.' }}
                </p>

                <div class="info">
                    <strong>Due Date:</strong>
                    {{ $task->due_date ?: 'No due date' }}
                </div>

                <div class="info">
                    <span class="status {{ strtolower($task->status) }}">
                        {{ $task->status }}
                    </span>
                </div>

                <div class="actions">

                    <form action="{{ route('tasks.status', $task) }}"
                          method="POST">
                        @csrf
                        @method('PATCH')

                        <button type="submit"
                                class="button status-button">
                            Change Status
                        </button>
                    </form>

                    <a href="{{ route('tasks.edit', $task) }}"
                       class="button edit-button">
                        Edit
                    </a>

                    <form action="{{ route('tasks.destroy', $task) }}"
                          method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="button delete-button"
                                onclick="return confirm('Are you sure you want to delete this task?')">
                            Delete
                        </button>
                    </form>

                </div>

            </div>

        @empty

            <div class="empty">
                <h3>No Tasks Yet</h3>
                <p>Click "Add Task" to create your first task.</p>
            </div>

        @endforelse

    </div>

</body>
</html>