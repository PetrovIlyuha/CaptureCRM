<!-- Page header -->
<section class="content-header">
    <h1 class="my-2">{{$title}}</h1>
    <a href="{{route('roles.create')}}" class="btn btn-success w-25">{{ __('Create') }}</a>

</section>
<!-- /page header -->

<!-- Content area -->
<div class="content">
    <!-- Hover rows -->
    <div class="card">
        <div class="table-responsive">
            @if($roles)
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="w-25">{{ __('ID') }}</th>
                        <th class="w-25">{{ __('Title') }}</th>
                        <th class="w-25">{{ __('Alias') }}</th>
                        <th>{{ __('Actions') }}</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->title}}</td>
                            <td>{{$role->alias}}</td>
                            <td class="d-flex">
                                <a href="{{route('roles.edit',['role'=>$role->id])}}"
                                   class="btn btn-primary btn-labeled mr-3" style="width: 100px;">{{ __('Edit') }}
                                </a>


                                <form method="post"  action="{{route('roles.delete',['role'=>$role->id])}}">
                                    @csrf
                                    @method('DELETE')
                                    <button  type="submit" class="btn btn-danger" style="width: 100px;">{{ __('Delete') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    <div style="display:none">
                        <form method="post" id="contact-applications-delete" action="">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>

                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <!-- /hover rows -->

</div>
<!-- /content area -->
