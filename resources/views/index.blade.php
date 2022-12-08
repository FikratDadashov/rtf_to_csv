@extends('template')
@section('content')
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid" style="margin-top:65px;">
        <div class="card">
            <form enctype="multipart/form-data" class="form" action="{{url('/upload')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="control-label col-form-label">Select File</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input required name="rtf_file" type="file" accept=".rtf"
                                               class="custom-file-input" id="inputGroupFile01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                    <input class="btn btn-info ml-3" type="submit" value="Add file">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="card">
            <div class="card card-body">
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered text-center">
                        <thead>
                        <tr>
                            <th><b>Name</b></th>
                            <th><b>Upload Date</b></th>
                            <th><b>Operation</b></th>
                        </tr>
                        </thead>
                        <tbody>
                        {{--                            {{dd($files)}}--}}
                        @foreach($files as $file)
                            {{--                                {{dd($file)}}--}}
                            <tr>
                                <td>{{$file->name}}</td>
                                <td>{{$file->created_at}}</td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <div class="btn-group" style="font-size: 16px;">
                                        {{--                                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                        <a href="{{url('/download/'.$file->id)}}"><i class="ti-download" style="color: black;"></i></a>
                                        {{--                                            </button>--}}
                                        <a href="{{url('/delete/'.$file->id)}}"><i class="ti-trash ml-3" style="color: black;"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>

    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
@endsection



