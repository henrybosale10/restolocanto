<x-guest-layout>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 1rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 1rem;
        }

        .conversation-box {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            max-height: 60vh;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 1rem;
            border-radius: 8px;
            background-color: #fafafa;
        }

        .message {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .message.admin {
            justify-content: flex-start;
        }

        .message.user {
            justify-content: flex-end;
            text-align: right;
        }

        .avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background-color: #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
        }

        .message-content {
            max-width: 70%;
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }

        .message-content.admin {
            background-color: #f0f0f0;
            color: #333;
        }

        .message-content.user {
            background-color: #007bff;
            color: #fff;
        }

        .timestamp {
            font-size: 0.8rem;
            color: #666;
            margin-top: 0.2rem;
        }

        .delete-btn {
            font-size: 0.8rem;
            color: red;
            text-decoration: none;
            cursor: pointer;
            margin-top: 0.2rem;
        }

        .delete-btn:hover {
            text-decoration: underline;
        }

        .form-box {
            display: flex;
            margin-top: 1rem;
            gap: 0.5rem;
        }

        .message-input {
            flex: 1;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .send-btn {
            padding: 0.5rem 1rem;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .send-btn:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="container">
        <div class="header">
            <h2>Conversation</h2>
        </div>

        <div class="conversation-box">
            @foreach ($messages as $msg)
                <div class="message {{ $msg->is_admin ? 'admin' : 'user' }}">
                    @if ($msg->is_admin)
                        <div class="avatar">A</div>
                        <div>
                            <div class="message-content admin">
                                {{ $msg->message }}
                            </div>
                            <div class="timestamp">{{ $msg->created_at->format('d/m/Y H:i') }}</div>
                            <form action="{{ route('conversation.delete', $msg->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">Supprimer</button>
                            </form>
                        </div>
                    @else
                        <div>
                            <div class="message-content user">
                                {{ $msg->message }}
                            </div>
                            <div class="timestamp">{{ $msg->created_at->format('d/m/Y H:i') }}</div>
                            <form action="{{ route('conversation.delete', $msg->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">Supprimer</button>
                            </form>
                        </div>
                        <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    @endif
                </div>
            @endforeach
        </div>

        <form action="{{ route('conversation.send') }}" method="POST" class="form-box">
            @csrf
            <textarea name="message" class="message-input" rows="1" placeholder="Écrire un message..." required></textarea>
            <button type="submit" class="send-btn">Envoyer</button>
        </form>
    </div>
</x-guest-layout>
