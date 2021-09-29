@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <form method="POST" action="{{ route('search') }}">
                            @csrf
                            <div class="form-group">
                                <label for="inputSearch">@lang('Пошук у ЄДР з використанням API ring.org.ua')</label>
                                <input name="search"
                                       value="{{ ($searchValue) ?? '' }}"
                                       type="text"
                                       pattern="[0-9]{8}"
                                       title="@lang('Введіть 8 цифр')"
                                       class="form-control"
                                       id="inputSearch"
                                       placeholder="@lang('Введіть ІПН юридичної особи...')"
                                       required
                                >
                            </div>
                            <button type="submit" class="btn btn-primary">@lang('Шукати')</button>
                        </form>

                        @isset($searchResult)
                            @if($searchResult['status'] == 'ok')
                                <div class="mt-5">
                                    <p><label class="toast-header">@lang('ЄДРПОУ'):</label> {{ $searchResult['data']['edrpou'] }} </p>
                                    <p><label class="toast-header">@lang('Назва'):</label> {{ $searchResult['data']['name'] }} </p>
                                    <p><label class="toast-header">@lang('Статус'):</label> {{ $searchResult['data']['status'] }} </p>
                                    <p><label class="toast-header">@lang('Адреса'):</label> {{ $searchResult['data']['address'] }} </p>
                                    @isset($searchResult['data']['persons'])
                                        <div>
                                            <label class="toast-header">@lang('Посадові особи'):</label>
                                            <ul>
                                                @foreach( $searchResult['data']['persons'] as $row)
                                                    <li>{{ $row }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endisset

                                </div>
                            @else
                                <p>
                                    {{ $searchResult['msg'] }}
                                </p>
                            @endif
                        @endisset

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
