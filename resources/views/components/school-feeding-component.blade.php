<div class="card">
    <div class="card-body">
        {!! $schoolFeedingChart->container() !!}
    </div>
</div>
@section('scripts')
    {!! $schoolFeedingChart->script() !!}
@endsection
