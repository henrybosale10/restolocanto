<x-admin-layout>
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }

        h2 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        .conversation-box {
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            max-height: 400px;
            overflow-y: auto;
        }

        .admin-message,
        .user-message {
            margin-bottom: 15px;
            padding: 10px 15px;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .admin-message {
            background: #e1f5fe;
            align-self: flex-start;
        }

        .user-message {
            background: #e8f5e9;
            align-self: flex-end;
        }

        .admin-message p,
        .user-message p {
            margin: 0 0 5px;
            font-size: 0.9rem;
            color: #333;
        }

        .admin-message small,
        .user-message small {
            font-size: 0.75rem;
            color: #666;
            align-self: flex-end;
        }

        .alert {
            padding: 10px 15px;
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .alert.alert-success {
            background: #c3e6cb;
        }

        textarea.form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            resize: none;
            font-size: 1rem;
            margin-bottom: 10px;
        }

        button.btn {
            display: inline-block;
            background: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 15px;
            font-size: 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button.btn:hover {
            background: #0056b3;
        }

        .btn-primary {
            background: #007bff;
        }

        .btn-primary:hover {
            background: #0056b3;
        }
    </style>

<div class="container">
    <h2>Conversation avec {{ $messages->first()->user->name }}</h2>

    <div class="conversation-box">
        @foreach ($messages as $msg)
            <div class="{{ $msg->is_admin ? 'admin-message' : 'user-message' }}">
                <p>
                    <strong>{{ $msg->is_admin ? 'Admin' : 'Utilisateur' }}:</strong>
                    {{ $msg->message }}
                    <form action="{{ route('admin.repondre.destroy', $msg->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete" title="Supprimer">
                            🗑️
                        </button>
                    </form>
                </p>
                <small>{{ $msg->created_at->format('d/m/Y H:i') }}</small>
            </div>
        @endforeach
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.repondre.respond', $userId) }}" method="POST">
        @csrf
        <textarea name="message" class="form-control" rows="3" placeholder="Écrire une réponse..."></textarea>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>

<style>
    .btn-delete {
        background: none;
        border: none;
        color: red;
        cursor: pointer;
        font-size: 0.9rem;
        margin-left: 10px;
        transition: color 0.3s;
    }

    .btn-delete:hover {
        color: darkred;
    }
</style>

</x-admin-layout>
