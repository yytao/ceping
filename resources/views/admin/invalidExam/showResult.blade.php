<section class="content">
    @foreach($result as $k=>$item)
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ $k }}</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="display: block;">
                        <table class="table ">
                            <tbody>
                            @foreach($item as $k=>$value)
                                <tr>
                                    <td width="90%">{{ $value['question']->question }}</td>
                                    <td>{{ $value['title'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    @endforeach
</section>
