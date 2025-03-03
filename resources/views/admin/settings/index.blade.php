@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4>Settings</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <div class="list-group" id="list-tab" role="tablist">
                                    <a class="list-group-item list-group-item-action active" id="list-home-list"
                                        data-toggle="list" href="#list-home" role="tab">General</a>
                                    <a class="list-group-item list-group-item-action" id="list-profile-list"
                                        data-toggle="list" href="#list-profile" role="tab">Profile</a>
                                    <a class="list-group-item list-group-item-action" id="list-messages-list"
                                        data-toggle="list" href="#list-messages" role="tab">Messages</a>
                                    <a class="list-group-item list-group-item-action" id="list-settings-list"
                                        data-toggle="list" href="#list-settings" role="tab">Settings</a>
                                </div>
                            </div>
                            <div class="col-10">
                                <div class="tab-content" id="nav-tabContent">
                                    @include('admin.settings.general-settings')
                                    <div class="tab-pane fade" id="list-profile" role="tabpanel"
                                        aria-labelledby="list-profile-list">
                                        Deserunt cupidatat anim ullamco ut dolor anim sint nulla amet incididunt tempor ad
                                        ut pariatur officia culpa laboris occaecat. Dolor in nisi aliquip in non magna amet
                                        nisi sed commodo proident anim deserunt nulla veniam occaecat reprehenderit esse ut
                                        eu culpa fugiat nostrud pariatur adipisicing incididunt consequat nisi non amet.
                                    </div>
                                    <div class="tab-pane fade" id="list-messages" role="tabpanel"
                                        aria-labelledby="list-messages-list">
                                        In quis non esse eiusmod sunt fugiat magna pariatur officia anim ex officia nostrud
                                        amet nisi pariatur eu est id ut exercitation ex ad reprehenderit dolore nostrud sit
                                        ut culpa consequat magna ad labore proident ad qui et tempor exercitation in aute
                                        veniam et velit dolore irure qui ex magna ex culpa enim anim ea mollit consequat
                                        ullamco exercitation in.
                                    </div>
                                    <div class="tab-pane fade" id="list-settings" role="tabpanel"
                                        aria-labelledby="list-settings-list">
                                        Lorem ipsum culpa in ad velit dolore anim labore incididunt do aliqua sit veniam
                                        commodo elit dolore do labore occaecat laborum sed quis proident fugiat sunt
                                        pariatur. Cupidatat ut fugiat anim ut dolore excepteur ut voluptate dolore excepteur
                                        mollit commodo.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
    @endpush
@endsection
