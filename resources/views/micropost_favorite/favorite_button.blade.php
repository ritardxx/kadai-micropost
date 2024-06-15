    @if (Auth::user()->is_favorite($micropost->id))
        {{-- お気に入り解除ボタンのフォーム --}}
        <form method="POST" action="{{ route('favorites.unfavorite', $micropost->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-error btn-block normal-case" 
                onclick="return confirm('id = {{ $micropost->id }} のお気に入り登録を解除します。よろしいですか？')">Unfavorite</button>
        </form>
    @else
        {{-- お気に入り登録ボタンのフォーム --}}
        <form method="POST" action="{{ route('favorites.favorite', $micropost->id) }}">
            @csrf
            <button type="submit" class="btn btn-primary btn-block normal-case">Favorite</button>
        </form>
    @endif