<div class="card">
    <div class="card-body">
        {!! $getSchoolFeedingChart()->container() !!}
    </div>
</div>
@section('scripts')
    {!! $getSchoolFeedingChart()->script() !!}
@endsection
