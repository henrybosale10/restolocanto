<div class="container">
    <h1>Liste des avis</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <ul>
        @foreach ($avis as $item)
            <li>
                <strong>{{ $item->user->name }}</strong> : {{ $item->avis }}
                (Note : {{ $item->note }}/5)
            </li>
        @endforeach
    </ul>
</div>
