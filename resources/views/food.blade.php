<!--  カテゴリープルダウン -->
<form action="{{ route('food.store') }}" method="POST">
    <div class="form-group">
        <label for="category-id">{{ __('食材') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
        <select class="form-control" id="category-id" name="category_id">
            @foreach($foods as $key => $food)
                <option value="{{ $key }}">{{ $food }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="category-id">{{ __('個数') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
        <select class="form-control" id="category-id" name="category_id">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </div>
    <x-button class="ml-4">
        {{ __('登録') }}
    </x-button>
</form>
