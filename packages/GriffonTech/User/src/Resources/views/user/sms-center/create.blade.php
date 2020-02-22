@extends('user::layouts.master')

@section('title') SMS Center Create @stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">SMS Center Create</h4>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <form action="">

                                <div class="form-group">
                                    <label for="property_id"> Property </label>
                                    <select id="property_id" class="form-control">
                                        <option value="">--Select Property </option>
                                        @if ($properties)
                                            @foreach($properties as $id => $property)
                                                <option value="{{ $id }}"> {{ $property }} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="search_param"> Lease Expiration </label>
                                    <select class="form-control" name="search_param" id="search_param">
                                        <otpion></otpion>
                                        <option value="less_than_2_months">Less Than 2 Month</option>
                                        <option value="expired"> Expired </option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-8">
                            <div id="data-table" class="m-b-20" style="max-height: 200px;">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <td>#</td>
                                        <td>Identifier</td>
                                        <td>Name</td>
                                        <td> Duration </td>
                                    </tr>
                                    </thead>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>


                            <div class="m-t-20">
                                <form action="">

                                    <div class="form-group">
                                        <label for="sms-message">SMS Message</label>
                                        <textarea class="form-control" name="sms_message" id="sms-message" cols="" rows="5"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">Send Message</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script>
        (function(){
            $('select').change(function(event){
                getTenants();
            });

            var getTenants = function(){
                var property_id = $('#property_id').val();
                var search_param = $('#search_param').val();
                if (property_id && search_param){
                    var url = document.location.origin+'/user/properties/get_tenants/' + property_id +'?search_param='
                        + search_param;
                    console.log(url);
                    $.get(url, function(data, statusText){
                       if (data) {
                            $('#data-table').html(data.render);
                           console.log(data);
                       }
                    });
                }
            }
        })();
    </script>
@stop
