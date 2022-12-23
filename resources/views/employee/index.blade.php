@extends('layouts.app', [
'class' => 'sidebar-mini ',
'namePage' => 'Index Employees',
'activePage' => 'employee',
'activeNav' => '',
])

@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <!-- <h5 class="title">{{__(" Companies")}}</h5> -->
          <a class="btn btn-primary" href="{{route('employee.create')}}"><i class="now-ui-icons ui-1_simple-add"></i>
            Add</a>
        </div>
        <div class="card-body">
          @include('alerts.success')
          <table class="table">
            <thead class=" text-primary">
              <th>
                No
              </th>
              <th>
                Name
              </th>
              <th>
                Company
              </th>
              <th>
                Email
              </th>
              <th>
                Action
              </th>
            </thead>
            @foreach($data as $index => $item)
            <tbody>
              <tr>
                <td>
                  {{ ++$index }}
                </td>
                <td>
                  {{$item->name}}
                </td>
                <td>
                  {{$item->company}}
                </td>
                <td>
                  {{$item->email}}
                </td>
                <td>
                  <form action="{{ route('employee.destroy',$item->id) }}" method="POST">
                    {{-- <a class="btn btn-info" href="{{ route('employee.show',$item->id) }}">Show</a> --}}
                    <a class="btn btn-primary" href="{{ route('employee.edit',$item->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
                </td>
              </tr>
            </tbody>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection