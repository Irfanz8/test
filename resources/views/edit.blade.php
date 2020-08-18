@extends('head')

@section('content')
@php
 $id_companies = $users->companies->id_companies;   
@endphp
<h3>Edit Users</h3>
<form method="POST" action="/edit_process/{{ $users->user_id }}">
    @method('put')
    {{ csrf_field() }}
    <div class="form-group">
      <label for="exampleFormControlInput1">First Name</label>
    <input type="text" class="form-control @error('first_name') is-invalid @enderror" style="width:500px;" name="first_name" value="{{$users->first_name}}" placeholder="First Name">
    @error('first_name')
    <div class="invalid-feedback">{{$message}}</div>
    @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Last Name</label>
        <input type="text" class="form-control" style="width:500px;" name="last_name" placeholder="Last Name" value="{{$users->last_name}}">
        @error('last_name')
    <div class="invalid-feedback">{{$message}}</div>
    @enderror
      </div>
    <div class="form-group">
      <label for="exampleFormControlSelect1">Companies</label><br>
      <select class="companies form-control" style="width:500px;" name="companies">
        @foreach($companies as $companies)
        <option value="{{ $companies->id_companies }}" {{ $companies->id_companies == $users->id_companies ? 'selected' : '' }}>{{ $companies->name }}</option>
            @endforeach
        </select>
      @error('companies')
    <div class="invalid-feedback">{{$message}}</div>
    @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Events</label><br>
        <select class="events form-control" style="width:500px;" name="events[]" multiple="multiple">
          @foreach($event as $event)
          <option value="{{ $event->id_event }}" {{ $event->user_id == $users->user_id ? 'selected' : '' }}>{{ $event->name }}</option>
              @endforeach
        </select>
        @error('events')
    <div class="invalid-feedback">{{$message}}</div>
    @enderror
      </div>
    </div>
    <div class="form-group">  
    <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
  @push('scripts')
<script>
    $(document).ready(function(){
          $('.companies').select2();
       });
       $(document).ready(function(){
          $('.events').select2();
       });
</script>
@endpush