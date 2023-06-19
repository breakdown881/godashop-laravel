@php
    $success = request()->session()->pull("success");
    $error = request()->session()->pull("error");
    if (!empty($error)) {
        $alertClass = "alert-danger";
        $message = $error;
    }
    elseif(!empty($success)) {
        $alertClass = "alert-success";
        $message = $success;
    }
@endphp
@if (!empty($message))
    <div class="alert {{$alertClass}}">
        {{$message}}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif