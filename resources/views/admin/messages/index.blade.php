    @extends('admin.app')
    @php
        $title = 'Messages';
        $sub_title = 'Pages';
    @endphp
    @section('title', $title)
    @section('content')
        <div class="d-flex flex-column flex-column-fluid">

            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                            {{ $title }}</h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a class="text-muted text-hover-primary">{{ $sub_title }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">{{ $title }}</li>
                        </ul>
                    </div>
     
                </div>
            </div>
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <div class="card">
                        <div class="card-body p-lg-17">

                            <table class="table table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Country</th>
                                        <th>Seen</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($messages as $message)
                                        <tr>
                                            <td>{{ $message->id }}</td>
                                            <td>{{ $message->name }}</td>
                                            <td>{{ $message->email }}</td>
                                            <td>{{ $message->country }}</td>
                                            <td>
                                                <span class="badge {{ $message->is_read ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $message->is_read ? 'Seen' : 'Unread' }}
                                                </span>
                                            </td>



                                            <td>
                                                <a href="{{ route('admin.messages.show', $message->id) }}"
                                                    class="btn btn-info btn-sm">Show</a>

                                                <form action="{{ route('admin.messages.destroy', $message->id) }}"
                                                    method="POST" style="display:inline-block;"
                                                    onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{ $messages->links('vendor.pagination.custom') }}



                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
