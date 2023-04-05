<!--  カテゴリープルダウン -->
<form action="{{ route('food.store') }}" method="POST">
    <x-label for="date" :value="__('購入日')" />
    <x-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date')" required autofocus />
    <div class="form-group">
        @csrf
        <label for="food-id">{{ __('食材') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
        <select class="form-control" id="food_id" name="food_id">
            @foreach($foods as $food)
                <option value="{{ $food->id }}">{{ $food->name }}</option>
            @endforeach
        </select>
{{--    </div>--}}

{{--    <div class="form-group">--}}
        <label for="food_num">{{ __('個数') }}<span class="badge badge-danger ml-2">{{ __('必須') }}</span></label>
        <select class="form-control" id="food_num" name="food_num">
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
