@include('admin.includes.trumbowyg-assets')
@include('admin.includes.color-picker')

<div class="page-title">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Block components') }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<div class="card">

    @include('admin.blocks.includes.menu-blocks')

    <div class="card-header">

        <div class="row">
            <div class="col-12 col-sm-5 col-md-6 order-md-1 order-first">
                <h4 class="card-title">{{ __('All blocks') }} ({{ $type }})</h4>
            </div>

            <div class="col-12 col-sm-7 col-md-6 order-md-2 order-last">
                <div class="float-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-block"><i
                            class="bi bi-plus-circle"></i> {{ __('New componnent') }} ({{ $type }})</button>
                    @include('admin.blocks.includes.modal-create-block')
                </div>
            </div>

        </div>

    </div>

    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                @if ($message == 'created')
                    {{ __('Created') }}
                @endif
                @if ($message == 'updated')
                    {{ __('Updated') }}
                @endif
                @if ($message == 'deleted')
                    {{ __('Deleted') }}
                @endif
            </div>
        @endif


        <div class="table-responsive-md">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="80">{{ __('Block ID') }}</th>
                        <th>{{ __('Block') }}</th>
                        <th width="350">{{ __('Shortcode') }}</th>
                        <th width="200">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($items as $item)
                        <tr @if ($item->active == 0) class="bg-light" @endif>
                            <td>
                                {{ $item->id }}
                            </td>
                            <td>
                                @if ($item->active == 0)
                                    <span class="badge bg-warning float-end ms-1">{{ __('Inactive') }}</span>
                                @endif

                                <h5>{{ $item->label }}</h5>
                                <div class="text-muted small">
                                    {{ __('Created at')}}: {{ $item->created_at }}
                                </div>
                            </td>

                            <td>
                                <div class="bg-light p-1">
                                    [block_{{ $type }} id={{ $item->id }}]
                                </div>
                            </td>

                            <td>
                                <div class="d-grid gap-2">
                                    <a href="{{ route('admin.block-components.block.show', ['type' => $item->type, 'id' => $item->id]) }}"
                                        class="btn btn-primary btn-sm mb-2">{{ __('Manage component') }}</a>
                                    
                                    <a href="#" data-bs-toggle="modal" data-bs-target=".confirm-{{ $item->id }}"
                                        class="btn btn-danger btn-sm">{{ __('Delete component') }}</a>
                                    <div class="modal fade confirm-{{ $item->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="ConfirmDeleteLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ConfirmDeleteLabel">
                                                        {{ __('Confirm delete') }}
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ __('Are you sure you want to delete this block component?') }}
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="POST"
                                                        action="{{ route('admin.block-components.block.delete', ['type' => $item->type, 'id' => $item->id]) }}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-danger">{{ __('Yes. Delete') }}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        {{ $items->links() }}

    </div>
    <!-- end card-body -->

</div>