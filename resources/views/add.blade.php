@extends('head')

@section('content')
<h3>Add User</h3>
<form method="POST" action="/add_process">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="exampleFormControlInput1">First Name</label>
    <input type="text" class="form-control @error('first_name') is-invalid @enderror" style="width:500px;" name="first_name" value="{{ old('first_name')}}" placeholder="First Name">
    @error('first_name')
    <div class="invalid-feedback">{{$message}}</div>
    @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Last Name</label>
        <input type="text" class="form-control" style="width:500px;" name="last_name" placeholder="Last Name" value="{{ old('last_name')}}">
        @error('last_name')
    <div class="invalid-feedback">{{$message}}</div>
    @enderror
      </div>
    <div class="form-group">
      <label for="exampleFormControlSelect1">Companies</label><br>
      <select class="companies form-control" style="width:500px;" name="companies" value="{{ old('companies')}}">
        </select>
      @error('companies')
    <div class="invalid-feedback">{{$message}}</div>
    @enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Events</label><br>
        <select class="events form-control" style="width:500px;" name="events[]" multiple="multiple">
        
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
    $('.companies').select2({
        placeholder: 'Companies...',
        ajax: {
        url: '/companies',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
            results:  $.map(data, function (item) {
                return {
                text: item.name,
                id: item.id_companies
                }
            })
            };
        },
        cache: true
        }
    });

    $('.events').select2({
        placeholder: 'Events...',
        ajax: {
        url: '/events',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
            results:  $.map(data, function (item) {
                return {
                text: item.name,
                id: item.id_event
                }
            })
            };
        },
        cache: true
        }
    });

</script>
@endpush